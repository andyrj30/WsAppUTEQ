<?php

/**
 * Database Object trait
 *
 * Trait That Performs Most Model database Operations
 *
 * @package Simple Framework
 * @author  Ahmed Saad <a7mad.sa3d.2014@gmail.com>
 * @license https://creativecommons.org/licenses/by-sa/4.0/legalcode.txt CC-BY-SA-4.0 Creative Commons Attribution Share Alike 4.0
 */

namespace App\Library;

use App\Library\App;
use PDO;

trait DatabaseObjectTrait {

    /**
     * PDO Instance
     * @var Object
     */
    protected static $DBH1;
    protected static $DBH2;

    /**
     * Start Application Database Connection
     * @return Object PDO Instance
     */
    public static function openConnection() {
        try {
            if (!isset(self::$DBH1)) {
                self::$DBH1 = mysqli_connect(DB_HOSTNAME1, DB_USERNAME1, DB_USERPWD1) or die('No se pudo conectar: ' . mysqli_error(self::$DBH1));
                mysqli_set_charset(self::$DBH1, 'utf8');
                mysqli_select_db(self::$DBH1, DB_NAME1) or die('No se pudo seleccionar la base de datos ' . mysqli_error(self::$DBH1));
                App::register('DBH1', self::$DBH1);
            }
            if (!isset(self::$DBH2)) {
                self::$DBH2 = mysqli_connect(DB_HOSTNAME2, DB_USERNAME2, DB_USERPWD2) or die('No se pudo conectar: ' . mysqli_error(self::$DBH2));
                mysqli_set_charset(self::$DBH2, 'utf8');
                mysqli_select_db(self::$DBH2, DB_NAME2) or die('No se pudo seleccionar la base de datos ' . mysqli_error(self::$DBH2));
                App::register('DBH2', self::$DBH2);
            }
        } catch (PDOException $e) {
            die('Database Error: ' . $e->getMessage());
        }
        # Method End
    }

    /**
     * Close Application Database Connection
     * @return Null
     */
    public static function closeConnection() {
        if (isset(self::$DBH1))
            self::$DBH1 = null;

        if (isset(self::$DBH2))
            self::$DBH2 = null;

        # Method End
    }

    /**
     * Get Database PDO Instance
     * @return Object PDO Instance OR Null
     */
    public static function getDBH($db = '1') {
        if ($db == '1') {
            if (!self::$DBH1)
                throw new Exception('there are no openned database connection');

            return self::$DBH1;
        }
        else {
            if (!self::$DBH2)
                throw new Exception('there are no openned database connection');

            return self::$DBH2;
        }

        # Method End
    }

    #################################################################

    /**
     * Count All Records For Current Model
     * @return Integer Records Count
     */
    public static function countAll($db = '1') {
        $sql = 'SELECT COUNT(*) FROM `' . static::$table_name . '`';

        $result = self::findBySql($db, $sql, null, array('fetch_all' => false, 'fetch_mode' => PDO::FETCH_NUM));

        return array_shift($result);

        # Method End
    }

    /**
     * Get All Model Records
     * @param  array  						$options 	Query Options
     * @return Array || Object || False          		Query Result
     */
    public static function all($db = '1', Array $options = array()) {
        #$fields = ( isset( $options['fields'] ) ) ? $options['fields'] : '*';

        $sql = 'SELECT * FROM `' . static::$table_name . '`';

        // self::completeQueryString( $sql, $options );

        return self::findBySql($db, $sql, null, $options);

        # Method End
    }

    /**
     * Get Model Record By Its Id
     * @param  Integer 					$id record id
     * @return Array || Object || false     query result
     */
    public static function findById($db = '1', $id, Array $options = array()) {
        $options['fetch_all'] = false;
        // $options['fetch_mode'] = PDO::FETCH_CLASS;

        $sql = 'SELECT * FROM `' . static::$table_name . '` WHERE `id` =' . $id;

        return self::findBySql($db, $sql, array('id' => $id), $options);

        # Method End
    }

    /**
     * Get Model Records That Matches Supplied Conditions
     * @param  Array  						$options Options
     * @return Array || Object || Boolean 	Query Result
     */
    public static function findWhere($db = '1', Array $field_value, Array $options = array()) {
        $options = array_merge(
                array('fetch_all' => false), $options
        );

        $conditions = array();

        foreach ($field_value as $field => $value) {
            $conditions[] = " `$field` = " . $value;


            $join_operator = ( isset($options['operator']) && $options['operator'] == 'OR' ) ? ' OR' : ' AND';

            unset($options['operator']);
        }
        $conditions = join($conditions, $join_operator);

        $sql = 'SELECT * FROM `' . static::$table_name . '` WHERE' . $conditions;

        // self::completeQueryString( $sql, $options );

        return self::findBySql($db, $sql, $field_value, $options);
        // return $sql;
        # Method End
    }

    /**
     * Get Model Records By Specific SQL Statement
     * @param  string 	$sql            	full query string
     * @param  array 	$prepare_values  	values to bind to query string
     * @param  array  	$options        	Query options contains fetch_all, fetch_mode
     * @return Array || Object || Boolean   return query result
     */
    public static function findBySql($db = '1', $sql, $prepare_values = null, Array $options = array()) {
        $options = array_merge(
                array('fetch_mode' => PDO::FETCH_CLASS, 'fetch_all' => true), $options
        );

        self::completeQueryString($sql, $options);

        if ($db == '1')
            $result = mysqli_query(self::$DBH1, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH1));
        else
            $result = mysqli_query(self::$DBH2, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH2));
        $rawdata = array();
        $i = 0;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rawdata[$i] = $row;
            $i++;
        }
        mysqli_free_result($result);
        return $rawdata;
    }

    /**
     * Helper Method To Complete SQL Statement 
     * @param  string $sql     query string
     * @param  array  $options query options
     */
    private static function completeQueryString(&$sql, &$options) {

        if (isset($options['order_by'])) {
            $sql .= ' ORDER BY ' . $options['order_by'];
            $sql .= ( isset($options['order']) ) ? ' ' . $options['order'] : null;
        }


        $sql .= ( isset($options['limit']) ) ? ' LIMIT ' . $options['limit'] : null;

        $sql .= ( isset($options['offset']) ) ? ' OFFSET ' . $options['offset'] : null;

        unset($options['limit'], $options['offset'], $options['order_by']);

        # Method End
    }

    #################################################################

    /**
     * Choose the correct action method of create or update
     * @return Integer number of inserted or updated rows
     */
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    /**
     * Insert record
     * @return Integer number of inserted rows
     */
    public function create($db = '1') {
        $this->castForSave();

        $field_value = array();

        foreach (static::$db_fields as $field)
            $field_value[$field] = $this->$field;


        $sql = 'INSERT INTO `' . static::$table_name . '` ( `' . join(static::$db_fields, '`, `') . '` ) VALUES ( :' . join(static::$db_fields, ', :') . ' )';

        if ($db == '1')
            $result = mysqli_query(self::$DBH1, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH1));
        else
            $result = mysqli_query(self::$DBH2, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH2));

        return ( $query->errorCode() + 0 ) ? false : $query->rowCount();
    }

    /**
     * Update record
     * @return Integer number of updated rows, 0 mean no change happens 'may be updated but to the same values, so with no changes'
     */
    public function update($db = '1') {
        $this->castForSave();

        $field_field = $field_value = array();

        foreach (static::$db_fields as $field) {
            $field_field[] = "`$field` = :$field";

            $field_value[$field] = $this->$field;
        }


        $sql = 'UPDATE `' . static::$table_name . '` SET ' . join($field_field, ' , ') . ' WHERE `id` = :id LIMIT 1';
        if ($db == '1')
            $result = mysqli_query(self::$DBH1, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH1));
        else
            $result = mysqli_query(self::$DBH2, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH2));

        return $result;

        # Method End
    }

    /**
     * Delete record
     * @return Integer number of deleted rows
     */
    public function delete($db = '1') {
        $sql = 'DELETE FROM `' . static::$table_name . '` WHERE `id` = :id';
        if ($db == '1')
            $result = mysqli_query(self::$DBH1, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH1));
        else
            $result = mysqli_query(self::$DBH2, $sql) or die('Consulta fallida: ' . mysqli_error(self::$DBH2));


        return $result;
    }

    /**
     * Delete record
     * @return Integer number of deleted rows
     */
    public static function checkCasting($set) {
        if (is_array($set)) {
            foreach ($set as &$instance)
                $instance->cast();
        } else
            $set->cast();

        return $set;
    }

    # Class End الحمد لله
}

?>