<?php
    class Model {
        protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = array();

        public $id;

        public function __construct($table) { 
            $this->_db = DB::getInstance();
            $this->_table = $table;
            $this->_setTableColumns();

            $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        }

        public function assign($params) {
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    if (in_array($key, $this->_columnNames))
                        $this->$key = sanitize($val);
                }
                return true;
            }
            return false;
        }

        public function data() {
            $data = new stdClass();
        
            foreach ($this->_columnNames as $column)
                $data->column = $column;
            return $data;
        }

        public function delete($id = '') {
            if ($id == '' && $this->id == '') return false;
            
            $id = ($id == '') ? $this->id : $id;

            if ($this->_softDelete)
                return $this->update($id, ['deleted' => 1]);
            return $this->_db->delete($this->_table, $id);
        }

        public function find($params = []) {
            $results = [];
            $resultsQuery = $this->_db->find($this->_table, $params);

            foreach ($resultsQuery as $result) {
                $obj = new $this->_modelName($this->_table);
                $obj->populateObjData($result);
                $results[] = $obj;
            }
            return $results;
        }

        public function findById($id) {
            return $this->_db->findFirst(['conditions' => "id = ?", 'bind' => [$id]]);
        }

        public function findFirst($params = []) {
            $resultQuery = $this->_db->findFirst($this->_table, $params);
            $result = new $this->_modelName($this->_table);

            if ($resultQuery)
                $result->populateObjData($resultQuery);
            
            return $result;
        }

        public function get_columns() {
            return $this->_db->get_columns($this->_table);
        }

        public function insert($fields) {
            if (!empty($fields))
                return $this->_db->insert($this->_table, $fields);
            return false;
        }

        protected function populateObjData($result) {
            foreach ($result as $key => $val) {
                $this->$key = $val;
            }
        }

        public function query($sql, $bind=[]) {
            return $this->_db->query($sql, $bind);
        }

        public function save() {
            $fields = [];

            foreach ($this->_columnNames as $column) {
                $fields[$column] = $this->$column;
            }

            if (property_exists($this, 'id') && $this->id != '')
                return $this->update($this->id, $fields);
            else
                return $this->insert($fields);
        }

        protected function _setTableColumns() {
            $columns = $this->get_columns();
            foreach ($columns as $column) {
                $columnName = $column->Field;
                $this->_columnNames[] = $column->Field;
                $this->{$columnName} = null;
            }
        }

        public function update($id, $fields) {
            if (!empty($fields) && $id != '')
                return $this->_db->update($this->_table, $id, $fields);
            return false;
        }
    }