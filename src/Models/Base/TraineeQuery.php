<?php

namespace Core\Models\Base;

use \Exception;
use \PDO;
use Core\Models\Trainee as ChildTrainee;
use Core\Models\TraineeQuery as ChildTraineeQuery;
use Core\Models\Map\TraineeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'trainee' table.
 *
 *
 *
 * @method     ChildTraineeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTraineeQuery orderByFullname($order = Criteria::ASC) Order by the fullname column
 * @method     ChildTraineeQuery orderByDni($order = Criteria::ASC) Order by the dni column
 * @method     ChildTraineeQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildTraineeQuery orderByAddress($order = Criteria::ASC) Order by the address column
 *
 * @method     ChildTraineeQuery groupById() Group by the id column
 * @method     ChildTraineeQuery groupByFullname() Group by the fullname column
 * @method     ChildTraineeQuery groupByDni() Group by the dni column
 * @method     ChildTraineeQuery groupByPhone() Group by the phone column
 * @method     ChildTraineeQuery groupByAddress() Group by the address column
 *
 * @method     ChildTraineeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTraineeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTraineeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTraineeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTraineeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTraineeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTraineeQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildTraineeQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildTraineeQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildTraineeQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildTraineeQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildTraineeQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildTraineeQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     \Core\Models\AttendanceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTrainee findOne(ConnectionInterface $con = null) Return the first ChildTrainee matching the query
 * @method     ChildTrainee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTrainee matching the query, or a new ChildTrainee object populated from the query conditions when no match is found
 *
 * @method     ChildTrainee findOneById(int $id) Return the first ChildTrainee filtered by the id column
 * @method     ChildTrainee findOneByFullname(string $fullname) Return the first ChildTrainee filtered by the fullname column
 * @method     ChildTrainee findOneByDni(string $dni) Return the first ChildTrainee filtered by the dni column
 * @method     ChildTrainee findOneByPhone(string $phone) Return the first ChildTrainee filtered by the phone column
 * @method     ChildTrainee findOneByAddress(string $address) Return the first ChildTrainee filtered by the address column *

 * @method     ChildTrainee requirePk($key, ConnectionInterface $con = null) Return the ChildTrainee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrainee requireOne(ConnectionInterface $con = null) Return the first ChildTrainee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrainee requireOneById(int $id) Return the first ChildTrainee filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrainee requireOneByFullname(string $fullname) Return the first ChildTrainee filtered by the fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrainee requireOneByDni(string $dni) Return the first ChildTrainee filtered by the dni column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrainee requireOneByPhone(string $phone) Return the first ChildTrainee filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrainee requireOneByAddress(string $address) Return the first ChildTrainee filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrainee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTrainee objects based on current ModelCriteria
 * @method     ChildTrainee[]|ObjectCollection findById(int $id) Return ChildTrainee objects filtered by the id column
 * @method     ChildTrainee[]|ObjectCollection findByFullname(string $fullname) Return ChildTrainee objects filtered by the fullname column
 * @method     ChildTrainee[]|ObjectCollection findByDni(string $dni) Return ChildTrainee objects filtered by the dni column
 * @method     ChildTrainee[]|ObjectCollection findByPhone(string $phone) Return ChildTrainee objects filtered by the phone column
 * @method     ChildTrainee[]|ObjectCollection findByAddress(string $address) Return ChildTrainee objects filtered by the address column
 * @method     ChildTrainee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TraineeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Core\Models\Base\TraineeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\Core\\Models\\Trainee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTraineeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTraineeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTraineeQuery) {
            return $criteria;
        }
        $query = new ChildTraineeQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTrainee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TraineeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TraineeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTrainee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, fullname, dni, phone, address FROM trainee WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTrainee $obj */
            $obj = new ChildTrainee();
            $obj->hydrate($row);
            TraineeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTrainee|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TraineeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TraineeTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TraineeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TraineeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraineeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByFullname('fooValue');   // WHERE fullname = 'fooValue'
     * $query->filterByFullname('%fooValue%', Criteria::LIKE); // WHERE fullname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByFullname($fullname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraineeTableMap::COL_FULLNAME, $fullname, $comparison);
    }

    /**
     * Filter the query on the dni column
     *
     * Example usage:
     * <code>
     * $query->filterByDni('fooValue');   // WHERE dni = 'fooValue'
     * $query->filterByDni('%fooValue%', Criteria::LIKE); // WHERE dni LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dni The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByDni($dni = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dni)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraineeTableMap::COL_DNI, $dni, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraineeTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraineeTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query by a related \Core\Models\Attendance object
     *
     * @param \Core\Models\Attendance|ObjectCollection $attendance the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTraineeQuery The current query, for fluid interface
     */
    public function filterByAttendance($attendance, $comparison = null)
    {
        if ($attendance instanceof \Core\Models\Attendance) {
            return $this
                ->addUsingAlias(TraineeTableMap::COL_ID, $attendance->getTraineeId(), $comparison);
        } elseif ($attendance instanceof ObjectCollection) {
            return $this
                ->useAttendanceQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAttendance() only accepts arguments of type \Core\Models\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendance relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function joinAttendance($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendance');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Attendance');
        }

        return $this;
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Core\Models\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttendance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendance', '\Core\Models\AttendanceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTrainee $trainee Object to remove from the list of results
     *
     * @return $this|ChildTraineeQuery The current query, for fluid interface
     */
    public function prune($trainee = null)
    {
        if ($trainee) {
            $this->addUsingAlias(TraineeTableMap::COL_ID, $trainee->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the trainee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TraineeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TraineeTableMap::clearInstancePool();
            TraineeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TraineeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TraineeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TraineeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TraineeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TraineeQuery
