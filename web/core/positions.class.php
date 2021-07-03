<?php
    include_once 'db.class.php';

    class Positions extends DB{

        function add_position($position,$prizes){
            return DB::execute("INSERT INTO positions(position,prizes) VALUES(?,?)", [$position,$prizes]);
        }
        function fetch_positions(){
            return DB::fetchAll("SELECT * FROM positions ORDER BY position ",[]);
        }
        function fetch_limited_positions($limit){
            return DB::fetchAll("SELECT * FROM positions ORDER BY position LIMIT $limit ",[]);
        }
        function fetch_position($id){
            return DB::fetch("SELECT * FROM positions WHERE id = ? ",[$id] );
        }
        function delete_position($id){
            return DB::execute("DELETE FROM positions WHERE id = ? ",[$id] );
        }
        function update_position($position,$id){
            return DB::execute("UPDATE positions SET position = ?  WHERE id = ? ", [$position,$id]);
        }
       
        function positions_num(){
            return DB::num_row("SELECT id FROM positions ", []);
        }

        function check_position_existence($position){
            if (DB::num_row("SELECT id FROM positions WHERE position = ?", [$position]) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function check_edit_position_existence($position,$id){
            if (DB::num_row("SELECT id FROM positions WHERE position = ? AND id <> ? ", [$position,$id]) > 0) {
                return true;
            }
            else{
                return false;
            }
        }


        function fetch_position_products($position_id){
            return DB::fetchAll("SELECT *,products.id FROM products
            JOIN positions on positions.id = products.position_id
            WHERE products.position_id = ? AND  products.status = 1
            ORDER BY products.id DESC ",[$position_id]);
        }

        function fetch_paginated_position_products($sort_by, $records_per_page,$offset,$position_id){
            return DB::fetchAll("SELECT *,products.id FROM products
            JOIN positions on positions.id = products.position_id
            WHERE products.position_id = ? AND  products.status = 1 $sort_by
            LIMIT $records_per_page OFFSET $offset ",[$position_id]);
        }


        function position_product_nums($position_id){
            return DB::num_row("SELECT products.id FROM products WHERE products.position_id = ?",[$position_id]);
        }

        function position_active_product_nums($position_id){
            return DB::num_row("SELECT products.id FROM products WHERE products.position_id =? AND products.status  = 1",[$position_id]);
        }
    }
?>