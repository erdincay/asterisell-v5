<?php

/* $LICENSE 2017:
 *
 * Copyright (C) 2017 Massimo Zaniboni <massimo.zaniboni@asterisell.com>
 *
 * This file is part of Asterisell.
 *
 * Asterisell is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * Asterisell is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Asterisell. If not, see <http://www.gnu.org/licenses/>.
 * $
 */

sfLoader::loadHelpers(array('I18N', 'Debug', 'Date', 'Asterisell'));

/**
 * Export Calls to a CSV file.
 */
class CSVCallDetails extends BaseBillingReport
{

    ///////////////////////////////
    // ReportGenerator Interface //
    ///////////////////////////////

    public function deriveReportParams() {
        $report = $this->getArReport();
        $report->setParamShowCallDetails(true);
        $report->setProducedReportMimeType('text/csv');
        $report->setProducedReportFileTypeSuffix('csv');
    }

    protected function internalGenerateReport()
    {
        $info = OrganizationUnitInfo::getInstance();

        $conn = Propel::getConnection();

        $report = $this->getArReport();
        $isDraftReport = $report->getProducedReportIsDraft();
        $fromDate = fromMySQLTimestampToUnixTimestamp($report->getFromDate());
        $startOrganizationId = $this->getArReport()->getArOrganizationUnitId();
        $startOrganizationHierarchy = $info->getFullIds($startOrganizationId, $fromDate);

        $useMaskedTelephoneNumbers = $report->getParamShowMaskedTelephoneNumbers();
        if (is_null($useMaskedTelephoneNumbers)) {
            $useMaskedTelephoneNumbers = true;
        }

        /**
         * @var string $content the content of the report
         * NOTE: it assumes that all the report content can be stored in the RAM of the server,
         * before serializating the result.
         */
        $content = '';

        // Set UTF-8 encoding
        $content .= "\xEF\xBB\xBF";

        //
        // Header
        //

        $line = '';
        $line .= csv_field(mytr('DID'), true);
        $line .= csv_field(mytr('Direction'), false);
        $line .= csv_field(mytr('Telephone Number'), false);
        $line .= csv_field(mytr('Location'), false);
        $line .= csv_field(mytr('Connection'), false);
        $line .= csv_field(mytr('Date'), false);
        $line .= csv_field(mytr('Duration'), false);

        foreach ($this->getReportNamesOfCostColumn() as $typeName) {
            $line .= csv_field(mytr($typeName), false);
        }

        if ($this->getShowVoipProvider()) {
            $line .= csv_field(mytr('Vendor'), false);
        }

        if ($this->getShowCommunicationChannel()) {
            $line .= csv_field(mytr('Channel'), false);
        }
        $content .= $line;

        //
        // Retrieve calls
        //

        $additionalQueryCond = 'AND ar_cdr.cached_parent_id_hierarchy LIKE ?';
        $query = $this->getQueryOnCdrs($additionalQueryCond);
        $stmt = $conn->prepare($query);
        $stmt->execute(array($startOrganizationHierarchy . '%'));
        $names = array();

        while (($rs = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $line = "\r\n";

            $callDate = fromMySQLTimestampToUnixTimestamp($rs['calldate']);

            $ids = $rs['cached_parent_id_hierarchy'];
            if (!array_key_exists($ids, $names)) {
                $organizationId = $rs['ar_organization_unit_id'];
                $names[$ids] = $info->getFullNameAtDate($organizationId, $callDate, false, false, $startOrganizationId, false, false);
            }
            $name = $names[$ids];

            $line .= csv_field($name, true);
            $line .= csv_field(DestinationType::getName($rs['destination_type'], false), false);

            if ($useMaskedTelephoneNumbers) {
                $line .= csv_field($rs['cached_masked_external_telephone_number'], false);
            } else {
               $line .= csv_field($rs['cached_external_telephone_number'], false);
            }

            $line .= csv_field($rs['geographic_location'], false);
            $line .= csv_field($rs['operator_type'], false);
            $line .= csv_field(fromUnixTimestampToMySQLTimestamp($callDate), false);
            $line .= csv_numeric_field($rs['duration'], false);

            foreach ($this->getShowType() as $type) {
                if ($type == self::SHOW_COST_SAVING) {
                    $v = $rs['cost_saving'];
                } else if ($type == self::SHOW_COST) {
                    $v = $rs['cost'];
                } else if ($type == self::SHOW_INCOME) {
                    $v = $rs['income'];
                } else if ($type == self::SHOW_EARN) {
                    $v = intval($rs['income']) - intval($rs['cost']);
                } else {
                    $v = '?';
                }

                $line .= csv_numeric_field(from_db_decimal_to_locale_decimal_with_full_precision($v), false);
            }

            if ($this->getShowVoipProvider()) {
                $line .= csv_field($rs['vendor_name'], false);
            }

            if ($this->getShowCommunicationChannel()) {
                $line .= csv_field($rs['channel_name'], false);
            }

            $content .= $line;
        }

        $stmt->closeCursor();

        // Save the report
        $report->setProducedReportAlreadyReviewed(false);
        $report->setProducedReportIsDraft($isDraftReport);
        $report->setProducedReportMimeType('text/csv');
        $report->setDocumentContent($content);
        $report->setProducedReportFileTypeSuffix('csv');
        $report->save();
    }
}
