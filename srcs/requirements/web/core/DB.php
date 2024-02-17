<?php
    require_once(ROOT . DS . 'config' . DS . 'config.php');
    class DB { 

        private static $_instance = null;
        private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_lastInsertID = null;
        
        private function __construct() {
            try {
                $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public static function getInstance() {
            if (!isset(self::$_instance))
                self::$_instance = new DB();
            return self::$_instance;
        }

        public function error() {
            return $this->_error;
        }

        public function action($action, $table, $where = []) {
            if (count($where) === 3) {
                $operators = ['=', '>', '<', '>=', '<='];
                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];
                if (in_array($operator, $operators)) {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                    if (!$this->query($sql, [$value])->error())
                        return $this;
                }
            }
            return false;
        }

        public function delete($table, $id) {
            $sql = "DELETE FROM {$table} WHERE id = {$id}";
            if (!$this->query($sql)->error())
                return true;
            return false;
        }

        public function find($table, $where = []) {
            return $this->action('SELECT *', $table, $where);
        }

        public function findFirst($table, $params = []) {
            if ($this->read($table, $params))
                return $this->first();
            return false;
        }

        public function first() {
            return $this->results()[0];
        }

        public function count() {
            return $this->_count;
        }

        public function get_columns($table) {
            return $this->query("SHOW COLUMNS FROM {$table}")->results();
        }

        public function get($table, $where) {
            return $this->action('SELECT *', $table, $where);
        }

        public function insert($table, $fields = []) {
            $fieldString = '';
            $valueString = '';
            $values = [];
            foreach ($fields as $field => $value) {
                $fieldString .= '`' . $field . '`,';
                $valueString .= '?,';
                $values[] = $value;
            }
            $fieldString = rtrim($fieldString, ',');
            $valueString = rtrim($valueString, ',');
            $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
            if (!$this->query($sql, $values)->error())
                return true;
            return false;
        }

        public function lastID() {
            return $this->_lastInsertID;
        }

        public function query($sql, $params = []) {
            $this->_error = false;
            if ($this->_query = $this->_pdo->prepare($sql)) {
                $x = 1;
                if (count($params)) {
                    foreach ($params as $param) {
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }
                if ($this->_query->execute()) {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                    $this->_lastInsertID = $this->_pdo->lastInsertId();
                } else
                    $this->_error = true;
            }
            return $this;
        }

        public function read($table, $params=[]) {
            $conditionString = '';
            $bind = [];
            $order = '';
            $limit = '';

            if (isset($params['conditions'])) {
                if (is_array($params['conditions'])) {
                    foreach ($params['conditions'] as $condition) {
                        $conditionString .= ' ' . $condition . ' AND';
                    }
                    $conditionString = trim($conditionString);
                    $conditionString = rtrim($conditionString, ' AND');
                } else
                    $conditionString = $params['conditions'];
                if ($conditionString != '')
                    $conditionString = ' WHERE ' . $conditionString;
            }
            if (array_key_exists('bind', $params))
                $bind = $params['bind'];
            if (array_key_exists('order', $params))
                $order = ' ORDER BY ' . $params['order'];
            if (array_key_exists('limit', $params))
                $limit = ' LIMIT ' . $params['limit'];

            $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
            if ($this->query($sql, $bind))
                if (!count($this->_results))
                    return false;
            return true;
        }

        public function results() {
            return $this->_results;
        }

        public function update($table, $id, $fields = []) {
            $fieldString = '';
            $values = [];
            foreach ($fields as $field => $value) {
                $fieldString .= ' ' . $field . ' = ?,';
                $values[] = $value;
            }
            $fieldString = trim($fieldString);
            $fieldString = rtrim($fieldString, ',');
            $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
            if (!$this->query($sql, $values)->error())
                return true;
            return false;
        }
    }