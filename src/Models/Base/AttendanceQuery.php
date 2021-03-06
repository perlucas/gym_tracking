<?php

namespace Core\Models\Base;

use \Exception;
use \PDO;
use Core\Models\Attendance as ChildAttendance;
use Core\Models\AttendanceQuery as ChildAttendanceQuery;
use Core\Models\Map\AttendanceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'gym_tracking.attendance' table.
 *
 *
 *
 * @method     ChildAttendanceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAttendanceQuery orderByTraineeId($order = Criteria::ASC) Order by the trainee_id column
 * @method     ChildAttendanceQuery orderByTimestamp($order = Criteria::ASC) Order by the timestamp column
 *
 * @method     ChildAttendanceQuery groupById() Group by the id column
 * @method     ChildAttendanceQuery groupByTraineeId() Group by the trainee_id column
 * @method     ChildAttendanceQuery groupByTimestamp() Group by the timestamp column
 *
 * @method     ChildAttendanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAttendanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAttendanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAttendanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAttendanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAttendanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAttendanceQuery leftJoinTrainee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Trainee relation
 * @method     ChildAttendanceQuery rightJoinTrainee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Trainee relation
 * @method     ChildAttendanceQuery innerJoinTrainee($relationAlias = null) Adds a INNER JOIN clause to the query using the Trainee relation
 *
 * @method     ChildAttendanceQuery joinWithTrainee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Trainee relation
 *
 * @method     ChildAttendanceQuery leftJoinWithTrainee() Adds a LEFT JOIN clause and with to the query using the Trainee relation
 * @method     ChildAttendanceQuery rightJoinWithTrainee() Adds a RIGHT JOIN clause and with to the query using the Trainee relation
 * @method     ChildAttendanceQuery innerJoinWithTrainee() Adds a INNER JOIN clause and with to the query using the Trainee relation
 *
 * @method     \Core\Models\TraineeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAttendance findOne(ConnectionInterface $con = null) Return the first ChildAttendance matching the query
 * @method     ChildAttendance findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAttendance matching the query, or a new ChildAttendance object populated from the query conditions when no match is found
 *
 * @method     ChildAttendance findOneById(int $id) Return the first ChildAttendance filtered by the id column
 * @method     ChildAttendance findOneByTraineeId(int $trainee_id) Return the first ChildAttendance filtered by the trainee_id column
 * @method     ChildAttendance findOneByTimestamp(string $timestamp) Return the first ChildAttendance filtered by the timestamp column *

 * @method     ChildAttendance requirePk($key, ConnectionInterface $con = null) Return the ChildAttendance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOne(ConnectionInterface $con = null) Return the first ChildAttendance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance requireOneById(int $id) Return the first ChildAttendance filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByTraineeId(int $trainee_id) Return the first ChildAttendance filtered by the trainee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByTimestamp(string $timestamp) Return the first ChildAttendance filtered by the timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAttendance objects based on current ModelCriteria
 * @method     ChildAttendance[]|ObjectCollection findById(int $id) Return ChildAttendance objects filtered by the id column
 * @method     ChildAttendance[]|ObjectCollection findByTraineeId(int $trainee_id) Return ChildAttendance objects filtered by the trainee_id column
 * @method     ChildAttendance[]|ObjectCollection findByTimestamp(string $timestamp) Return ChildAttendance objects filtered by the timestamp column
 * @method     ChildAttendance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AttendanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Core\Models\Base\AttendanceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\Core\\Models\\Attendance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAttendanceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAttendanceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAttendanceQuery) {
            return $criteria;
        }
        $query = new ChildAttendanceQuery();
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AttendanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAttendance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, trainee_id, timestamp FROM gym_tracking.attendance WHERE id = :p0';
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
            /** @var ChildAttendance $obj */
            $obj = new ChildAttendance();
            $obj->hydrate($row);
            AttendanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AttendanceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AttendanceTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the trainee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTraineeId(1234); // WHERE trainee_id = 1234
     * $query->filterByTraineeId(array(12, 34)); // WHERE trainee_id IN (12, 34)
     * $query->filterByTraineeId(array('min' => 12)); // WHERE trainee_id > 12
     * </code>
     *
     * @see       filterByTrainee()
     *
     * @param     mixed $traineeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByTraineeId($traineeId = null, $comparison = null)
    {
        if (is_array($traineeId)) {
            $useMinMax = false;
            if (isset($traineeId['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_TRAINEE_ID, $traineeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($traineeId['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_TRAINEE_ID, $traineeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_TRAINEE_ID, $traineeId, $comparison);
    }

    /**
     * Filter the query on the timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByTimestamp('2011-03-14'); // WHERE timestamp = '2011-03-14'
     * $query->filterByTimestamp('now'); // WHERE timestamp = '2011-03-14'
     * $query->filterByTimestamp(array('max' => 'yesterday')); // WHERE timestamp > '2011-03-13'
     * </code>
     *
     * @param     mixed $timestamp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByTimestamp($timestamp = null, $comparison = null)
    {
        if (is_array($timestamp)) {
            $useMinMax = false;
            if (isset($timestamp['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_TIMESTAMP, $timestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timestamp['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_TIMESTAMP, $timestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_TIMESTAMP, $timestamp, $comparison);
    }

    /**
     * Filter the query by a related \Core\Models\Trainee object
     *
     * @param \Core\Models\Trainee|ObjectCollection $trainee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByTrainee($trainee, $comparison = null)
    {
        if ($trainee instanceof \Core\Models\Trainee) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_TRAINEE_ID, $trainee->getId(), $comparison);
        } elseif ($trainee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AttendanceTableMap::COL_TRAINEE_ID, $trainee->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTrainee() only accepts arguments of type \Core\Models\Trainee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Trainee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function joinTrainee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Trainee');

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
            $this->addJoinObject($join, 'Trainee');
        }

        return $this;
    }

    /**
     * Use the Trainee relation Trainee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Core\Models\TraineeQuery A secondary query class using the current class as primary query
     */
    public function useTraineeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTrainee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Trainee', '\Core\Models\TraineeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAttendance $attendance Object to remove from the list of results
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function prune($attendance = null)
    {
        if ($attendance) {
            $this->addUsingAlias(AttendanceTableMap::COL_ID, $attendance->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gym_tracking.attendance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AttendanceTableMap::clearInstancePool();
            AttendanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AttendanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AttendanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AttendanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AttendanceQuery
