<?php
    include_once 'db.class.php';

    class Users extends DB{

        function register($fullname,$matric_number,$phone){
            return DB::execute("INSERT INTO users(fullname,matric_number,phone) VALUES(?,?,?)", [$fullname,$matric_number,$phone]);
        }

        function fetch_users(){
            return DB::fetchAll("SELECT * FROM users ORDER BY users.id DESC ",[]);
        }

        function fetch_user($id){
            return DB::fetch("SELECT * FROM users WHERE users.id = ? OR users.matric_number = ? ",[$id,$id] );
        }

        function fetch_last_user($name){
            return DB::fetch("SELECT * FROM users WHERE name = ? ORDER BY id DESC LIMIT 1 ",[$name] );
        }
        
        function fetch_limited_users($limit){
            return DB::fetchAll("SELECT * FROM users ORDER BY id DESC LIMIT $limit ",[]);
        }

        function delete_user($id){
            return DB::execute("DELETE FROM users WHERE id = ? ",[$id] );
        }

        function change_user_image($image,$id){
            return DB::execute("UPDATE users set image = ? WHERE id = ? ",[$image,$id] );
        }

        function update_user($phone,$nickname,$team_id,$id){
            return DB::execute("UPDATE users SET phone = ?, nickname = ?, team_id = ? WHERE id = ? ", [$phone,$nickname,$team_id,$id]);
        }

        function update_basic_user_details($fullname,$matric_number,$phone,$state_id,$id){
            return DB::execute("UPDATE users SET fullname = ?, matric_number = ?, phone = ?, state_id = ? WHERE id = ? ", [$fullname,$matric_number,$phone,$state_id,$id]);
        }
       
        function users_num(){
            return DB::num_row("SELECT id FROM users ", []);
        }
          
        function user_bookings_num($user_id){
            return DB::num_row("SELECT id FROM bookings WHERE user_id = ? ", [$user_id]);
        }
       

        function check_matric_number_existence($matric_number){
            if (DB::num_row("SELECT id FROM users WHERE matric_number = ? ", [$matric_number]) > 0) {
                return true;
            }
            else{
                return false;
            }
        }

        function check_edit_matric_number_existence($matric_number,$id){
            if (DB::num_row("SELECT id FROM users WHERE matric_number = ? AND id <> ? ", [$matric_number,$id]) > 0) {
                return true;
            }
            else{
                return false;
            }
        }

        function login($matric_number,$password){
            if (DB::num_row("SELECT id FROM users WHERE matric_number = ? AND password = ? ", [$matric_number,$password])) {
                return true;
            }
            else{
                return false;
            }
        }

        //Comments
    }
?>