<?php
    include_once 'db.class.php';

    class Settings extends DB{

        
        function fetch_about(){
            return DB::fetch("SELECT * FROM about ",[] );
        }
        
        function update_about($about_text){
            return DB::execute("UPDATE about SET about_text = ? ", [$about_text]);
        }
       
        
        function fetch_rules(){
            return DB::fetch("SELECT * FROM rules ",[] );
        }
        
        function update_rules($rules){
            return DB::execute("UPDATE rules SET rules = ? ", [$rules]);
        }
       
        
    }
?>