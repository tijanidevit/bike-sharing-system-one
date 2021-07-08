<?php
    include_once 'db.class.php';

    class bikes extends DB{

        function add_bike($name,$image,$price_per_minute,$description){
            return DB::execute("INSERT INTO bikes(name,image,price_per_minute,description) VALUES(?,?,?,?)", [$name,$image,$price_per_minute,$description]);
        }
        function fetch_bikes(){
            return DB::fetchAll("SELECT * FROM bikes ORDER BY name ",[]);
        }
        function fetch_limited_bikes($limit){
            return DB::fetchAll("SELECT * FROM bikes ORDER BY id DESC LIMIT $limit ",[]);
        }
        function fetch_bike($id){
            return DB::fetch("SELECT * FROM bikes WHERE id = ? ",[$id] );
        }
        function delete_bike($id){
            return DB::execute("DELETE FROM bikes WHERE id = ? ",[$id] );
        }
        function update_bike_status($status,$id){
            return DB::execute("UPDATE bikes SET status = ?  WHERE id = ? ", [$status,$id]);
        }
       
        function bikes_num(){
            return DB::num_row("SELECT id FROM bikes ", []);
        }

        function check_bike_existence($name){
            if (DB::num_row("SELECT id FROM bikes WHERE name = ?", [$name]) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function check_edit_bike_existence($bike,$id){
            if (DB::num_row("SELECT id FROM bikes WHERE bike = ? AND id <> ? ", [$bike,$id]) > 0) {
                return true;
            }
            else{
                return false;
            }
        }


        function fetch_bike_products($bike_id){
            return DB::fetchAll("SELECT *,products.id FROM products
            JOIN bikes on bikes.id = products.bike_id
            WHERE products.bike_id = ? AND  products.status = 1
            ORDER BY products.id DESC ",[$bike_id]);
        }

        function fetch_paginated_bike_products($sort_by, $records_per_page,$offset,$bike_id){
            return DB::fetchAll("SELECT *,products.id FROM products
            JOIN bikes on bikes.id = products.bike_id
            WHERE products.bike_id = ? AND  products.status = 1 $sort_by
            LIMIT $records_per_page OFFSET $offset ",[$bike_id]);
        }


        function bike_product_nums($bike_id){
            return DB::num_row("SELECT products.id FROM products WHERE products.bike_id = ?",[$bike_id]);
        }

        function bike_active_product_nums($bike_id){
            return DB::num_row("SELECT products.id FROM products WHERE products.bike_id =? AND products.status  = 1",[$bike_id]);
        }
    }
?>