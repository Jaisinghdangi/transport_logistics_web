<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class CustomModel extends Model
    {
        public function Create ($table, $data)
        {
            $builder = $this->db->table($table);
            $builder->insert($data);
            if ($this->db->affectedRows() == 1) {
                return true;
            } else {
                return false;
            }
        }
        
        public function LastInsertId($table)
        {
            return $this->db->insertID($table);
        }
        
        public function UpdateSave ($table, $where, $data) 
        {
            $builder = $this->db->table($table);
            $builder->where($where);
            $builder->update($data);
            
            if ($this->db->affectedRows() == 1) {
                return true;
            } else {
                return false;
            }
        }
        
        public function NumRows ($table, $where=null) 
        {
            $builder = $this->db->table($table);
            if (!empty($where)) {
                $builder->where($where);
            }
            $result = $builder->get();
            $count = $result->getNumRows();
            return $count;
        }
        
        public function Row ($table, $where=null)
        {
            $builder = $this->db->table($table);
            if (!empty($where)) {
                $builder->where($where);
            }
            $result = $builder->get();
            
            if (count($result->getResultArray()) > 0) {
                return $result->getRow();
            } else {
                return false;
            }
        }
        
        public function Results ($table, $where=null, $orderby=null, $limit=null)
        {
            $builder = $this->db->table($table);
            if (!empty($where)) {
                $builder->where($where);
            }
            if (!empty($orderby)) {
                $builder->orderBy($orderby, 'DESC');
            }
            if (!empty($limit)) {
                $builder->limit($limit);
            }
            $result = $builder->get();
            
            if ($result->getResultArray() > 0) {
                return $result->getResult();
            } else {
                return false;
            }
        }
        
        public function SelectedResults ($table, $select=null, $where=null, $orderby=null, $limit=null)
        {
            $builder = $this->db->table($table);
            if (!empty($select)) {
                $builder->select($select);
            }
            if (!empty($where)) {
                $builder->where($where);
            }
            if (!empty($orderby)) {
                $builder->orderBy($orderby, 'DESC');
            }
            if (!empty($limit)) {
                $builder->limit($limit);
            }
            $result = $builder->get();
            
            if ($result->getResultArray() > 0) {
                return $result->getResult();
            } else {
                return false;
            }
        }
        
        public function Trash ($table, $where) 
        {
            $builder = $this->db->table($table);
            $builder->where($where);
            $result = $builder->delete();
            
            if ($result > 0) {
                return true;
            } else {
                return false;
            }        
        }
    }