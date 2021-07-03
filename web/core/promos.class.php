<?php
    include_once 'db.class.php';

    class Promos extends DB{

        function add_promo_code($promo_code,$number,$percentage){
            return DB::execute("INSERT INTO promo_codes(promo_code,numbers,percentage,availability) VALUES(?,?,?,?)", [$promo_code,$number,$percentage,$number]);
        }
        function fetch_promo_codes(){
            return DB::fetchAll("SELECT * FROM promo_codes ORDER BY promo_code ",[]);
        }
        function fetch_limited_promo_codes($limit){
            return DB::fetchAll("SELECT * FROM promo_codes ORDER BY promo_code LIMIT $limit ",[]);
        }
        function fetch_promo_code($id){
            return DB::fetch("SELECT * FROM promo_codes WHERE id = ? OR promo_code = ? ",[$id,$id] );
        }
        function delete_promo_code($id){
            return DB::execute("DELETE FROM promo_codes WHERE id = ? ",[$id] );
        }
        function update_promo_code_status($status,$id){
            return DB::execute("UPDATE promo_codes SET status = ?  WHERE id = ? ", [$status,$id]);
        }

        function update_promo_code_availability($availability,$id){
            return DB::execute("UPDATE promo_codes SET availability = ?  WHERE id = ? ", [$availability,$id]);
        }
       
        function promo_codes_num(){
            return DB::num_row("SELECT id FROM promo_codes ", []);
        }

        function check_promo_code_existence($promo_code){
            if (DB::num_row("SELECT id FROM promo_codes WHERE promo_code = ?", [$promo_code]) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function check_edit_promo_code_existence($promo_code,$id){
            if (DB::num_row("SELECT id FROM promo_codes WHERE promo_code = ? AND id <> ? ", [$promo_code,$id]) > 0) {
                return true;
            }
            else{
                return false;
            }
        }
    }
?>