<?php

/**
 * Base class that represents a row from the 'ar_tag' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseArTag extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArTagPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the internal_name field.
	 * @var        string
	 */
	protected $internal_name;

	/**
	 * The value for the note_for_admin field.
	 * @var        string
	 */
	protected $note_for_admin;

	/**
	 * The value for the name_for_customer field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $name_for_customer;

	/**
	 * The value for the note_for_customer field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $note_for_customer;

	/**
	 * @var        array ArPartyHasTag[] Collection to store aggregation of ArPartyHasTag objects.
	 */
	protected $collArPartyHasTags;

	/**
	 * @var        Criteria The criteria used to select the current contents of collArPartyHasTags.
	 */
	private $lastArPartyHasTagCriteria = null;

	/**
	 * @var        array ArReport[] Collection to store aggregation of ArReport objects.
	 */
	protected $collArReports;

	/**
	 * @var        Criteria The criteria used to select the current contents of collArReports.
	 */
	private $lastArReportCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'ArTagPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->name_for_customer = '';
		$this->note_for_customer = '';
	}

	/**
	 * Initializes internal state of BaseArTag object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [internal_name] column value.
	 * 
	 * @return     string
	 */
	public function getInternalName()
	{
		return $this->internal_name;
	}

	/**
	 * Get the [note_for_admin] column value.
	 * 
	 * @return     string
	 */
	public function getNoteForAdmin()
	{
		return $this->note_for_admin;
	}

	/**
	 * Get the [name_for_customer] column value.
	 * 
	 * @return     string
	 */
	public function getNameForCustomer()
	{
		return $this->name_for_customer;
	}

	/**
	 * Get the [note_for_customer] column value.
	 * 
	 * @return     string
	 */
	public function getNoteForCustomer()
	{
		return $this->note_for_customer;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ArTag The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ArTagPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [internal_name] column.
	 * 
	 * @param      string $v new value
	 * @return     ArTag The current object (for fluent API support)
	 */
	public function setInternalName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->internal_name !== $v) {
			$this->internal_name = $v;
			$this->modifiedColumns[] = ArTagPeer::INTERNAL_NAME;
		}

		return $this;
	} // setInternalName()

	/**
	 * Set the value of [note_for_admin] column.
	 * 
	 * @param      string $v new value
	 * @return     ArTag The current object (for fluent API support)
	 */
	public function setNoteForAdmin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->note_for_admin !== $v) {
			$this->note_for_admin = $v;
			$this->modifiedColumns[] = ArTagPeer::NOTE_FOR_ADMIN;
		}

		return $this;
	} // setNoteForAdmin()

	/**
	 * Set the value of [name_for_customer] column.
	 * 
	 * @param      string $v new value
	 * @return     ArTag The current object (for fluent API support)
	 */
	public function setNameForCustomer($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name_for_customer !== $v || $this->isNew()) {
			$this->name_for_customer = $v;
			$this->modifiedColumns[] = ArTagPeer::NAME_FOR_CUSTOMER;
		}

		return $this;
	} // setNameForCustomer()

	/**
	 * Set the value of [note_for_customer] column.
	 * 
	 * @param      string $v new value
	 * @return     ArTag The current object (for fluent API support)
	 */
	public function setNoteForCustomer($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->note_for_customer !== $v || $this->isNew()) {
			$this->note_for_customer = $v;
			$this->modifiedColumns[] = ArTagPeer::NOTE_FOR_CUSTOMER;
		}

		return $this;
	} // setNoteForCustomer()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->name_for_customer !== '') {
				return false;
			}

			if ($this->note_for_customer !== '') {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->internal_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->note_for_admin = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->name_for_customer = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->note_for_customer = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = ArTagPeer::NUM_COLUMNS - ArTagPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ArTag object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ArTagPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collArPartyHasTags = null;
			$this->lastArPartyHasTagCriteria = null;

			$this->collArReports = null;
			$this->lastArReportCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				ArTagPeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				ArTagPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ArTagPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ArTagPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ArTagPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collArPartyHasTags !== null) {
				foreach ($this->collArPartyHasTags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collArReports !== null) {
				foreach ($this->collArReports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = ArTagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collArPartyHasTags !== null) {
					foreach ($this->collArPartyHasTags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArReports !== null) {
					foreach ($this->collArReports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getInternalName();
				break;
			case 2:
				return $this->getNoteForAdmin();
				break;
			case 3:
				return $this->getNameForCustomer();
				break;
			case 4:
				return $this->getNoteForCustomer();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ArTagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getInternalName(),
			$keys[2] => $this->getNoteForAdmin(),
			$keys[3] => $this->getNameForCustomer(),
			$keys[4] => $this->getNoteForCustomer(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setInternalName($value);
				break;
			case 2:
				$this->setNoteForAdmin($value);
				break;
			case 3:
				$this->setNameForCustomer($value);
				break;
			case 4:
				$this->setNoteForCustomer($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ArTagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInternalName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNoteForAdmin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNameForCustomer($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNoteForCustomer($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArTagPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArTagPeer::ID)) $criteria->add(ArTagPeer::ID, $this->id);
		if ($this->isColumnModified(ArTagPeer::INTERNAL_NAME)) $criteria->add(ArTagPeer::INTERNAL_NAME, $this->internal_name);
		if ($this->isColumnModified(ArTagPeer::NOTE_FOR_ADMIN)) $criteria->add(ArTagPeer::NOTE_FOR_ADMIN, $this->note_for_admin);
		if ($this->isColumnModified(ArTagPeer::NAME_FOR_CUSTOMER)) $criteria->add(ArTagPeer::NAME_FOR_CUSTOMER, $this->name_for_customer);
		if ($this->isColumnModified(ArTagPeer::NOTE_FOR_CUSTOMER)) $criteria->add(ArTagPeer::NOTE_FOR_CUSTOMER, $this->note_for_customer);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ArTagPeer::DATABASE_NAME);

		$criteria->add(ArTagPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ArTag (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setInternalName($this->internal_name);

		$copyObj->setNoteForAdmin($this->note_for_admin);

		$copyObj->setNameForCustomer($this->name_for_customer);

		$copyObj->setNoteForCustomer($this->note_for_customer);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getArPartyHasTags() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArPartyHasTag($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getArReports() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArReport($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     ArTag Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ArTagPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArTagPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collArPartyHasTags collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArPartyHasTags()
	 */
	public function clearArPartyHasTags()
	{
		$this->collArPartyHasTags = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArPartyHasTags collection (array).
	 *
	 * By default this just sets the collArPartyHasTags collection to an empty array (like clearcollArPartyHasTags());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initArPartyHasTags()
	{
		$this->collArPartyHasTags = array();
	}

	/**
	 * Gets an array of ArPartyHasTag objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ArTag has previously been saved, it will retrieve
	 * related ArPartyHasTags from storage. If this ArTag is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ArPartyHasTag[]
	 * @throws     PropelException
	 */
	public function getArPartyHasTags($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArPartyHasTags === null) {
			if ($this->isNew()) {
			   $this->collArPartyHasTags = array();
			} else {

				$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

				ArPartyHasTagPeer::addSelectColumns($criteria);
				$this->collArPartyHasTags = ArPartyHasTagPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

				ArPartyHasTagPeer::addSelectColumns($criteria);
				if (!isset($this->lastArPartyHasTagCriteria) || !$this->lastArPartyHasTagCriteria->equals($criteria)) {
					$this->collArPartyHasTags = ArPartyHasTagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArPartyHasTagCriteria = $criteria;
		return $this->collArPartyHasTags;
	}

	/**
	 * Returns the number of related ArPartyHasTag objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArPartyHasTag objects.
	 * @throws     PropelException
	 */
	public function countArPartyHasTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collArPartyHasTags === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

				$count = ArPartyHasTagPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

				if (!isset($this->lastArPartyHasTagCriteria) || !$this->lastArPartyHasTagCriteria->equals($criteria)) {
					$count = ArPartyHasTagPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collArPartyHasTags);
				}
			} else {
				$count = count($this->collArPartyHasTags);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ArPartyHasTag object to this object
	 * through the ArPartyHasTag foreign key attribute.
	 *
	 * @param      ArPartyHasTag $l ArPartyHasTag
	 * @return     void
	 * @throws     PropelException
	 */
	public function addArPartyHasTag(ArPartyHasTag $l)
	{
		if ($this->collArPartyHasTags === null) {
			$this->initArPartyHasTags();
		}
		if (!in_array($l, $this->collArPartyHasTags, true)) { // only add it if the **same** object is not already associated
			array_push($this->collArPartyHasTags, $l);
			$l->setArTag($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArPartyHasTags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArPartyHasTagsJoinArParty($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArPartyHasTags === null) {
			if ($this->isNew()) {
				$this->collArPartyHasTags = array();
			} else {

				$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

				$this->collArPartyHasTags = ArPartyHasTagPeer::doSelectJoinArParty($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArPartyHasTagPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArPartyHasTagCriteria) || !$this->lastArPartyHasTagCriteria->equals($criteria)) {
				$this->collArPartyHasTags = ArPartyHasTagPeer::doSelectJoinArParty($criteria, $con, $join_behavior);
			}
		}
		$this->lastArPartyHasTagCriteria = $criteria;

		return $this->collArPartyHasTags;
	}

	/**
	 * Clears out the collArReports collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArReports()
	 */
	public function clearArReports()
	{
		$this->collArReports = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArReports collection (array).
	 *
	 * By default this just sets the collArReports collection to an empty array (like clearcollArReports());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initArReports()
	{
		$this->collArReports = array();
	}

	/**
	 * Gets an array of ArReport objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ArTag has previously been saved, it will retrieve
	 * related ArReports from storage. If this ArTag is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ArReport[]
	 * @throws     PropelException
	 */
	public function getArReports($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
			   $this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				ArReportPeer::addSelectColumns($criteria);
				$this->collArReports = ArReportPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				ArReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
					$this->collArReports = ArReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArReportCriteria = $criteria;
		return $this->collArReports;
	}

	/**
	 * Returns the number of related ArReport objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArReport objects.
	 * @throws     PropelException
	 */
	public function countArReports(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$count = ArReportPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
					$count = ArReportPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collArReports);
				}
			} else {
				$count = count($this->collArReports);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ArReport object to this object
	 * through the ArReport foreign key attribute.
	 *
	 * @param      ArReport $l ArReport
	 * @return     void
	 * @throws     PropelException
	 */
	public function addArReport(ArReport $l)
	{
		if ($this->collArReports === null) {
			$this->initArReports();
		}
		if (!in_array($l, $this->collArReports, true)) { // only add it if the **same** object is not already associated
			array_push($this->collArReports, $l);
			$l->setArTag($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArReportSetRelatedByArReportSetId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArReportSetRelatedByArReportSetId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArReportSetRelatedByArReportSetId($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArReportSetRelatedByAboutArReportSetId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArReportSetRelatedByAboutArReportSetId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArReportSetRelatedByAboutArReportSetId($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArOrganizationUnit($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArOrganizationUnit($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArOrganizationUnit($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArVendor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArVendor($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArVendor($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArTag is new, it will return
	 * an empty collection; or if this ArTag has previously
	 * been saved, it will retrieve related ArReports from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArTag.
	 */
	public function getArReportsJoinArReportOrderOfChildren($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ArTagPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArReports === null) {
			if ($this->isNew()) {
				$this->collArReports = array();
			} else {

				$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

				$this->collArReports = ArReportPeer::doSelectJoinArReportOrderOfChildren($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArReportPeer::AR_TAG_ID, $this->id);

			if (!isset($this->lastArReportCriteria) || !$this->lastArReportCriteria->equals($criteria)) {
				$this->collArReports = ArReportPeer::doSelectJoinArReportOrderOfChildren($criteria, $con, $join_behavior);
			}
		}
		$this->lastArReportCriteria = $criteria;

		return $this->collArReports;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collArPartyHasTags) {
				foreach ((array) $this->collArPartyHasTags as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collArReports) {
				foreach ((array) $this->collArReports as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collArPartyHasTags = null;
		$this->collArReports = null;
	}

} // BaseArTag
