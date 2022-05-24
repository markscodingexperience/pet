<?php
class Pet extends CI_Model {
     function get_all_clinics()
     {
         return $this->db->query("SELECT * FROM clinics")->result_array();
     }
     function get_clinic_by_id($clinic_id)
     {
         return $this->db->query("SELECT * FROM clinics WHERE id = ?", array($clinic_id))->row_array();
     }
     function add_clinic($user)
     {
         $query = "INSERT INTO clinics(clinic_name, user_id, country, unit_number, street, municipality, city, telephone, contact_number, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
         $values = array($user['name'], $user['user_id'], $user['country'], $user['unit_number'], 
            $user['street'], $user['municipality'], $user['city'], $user['telephone'], $user['contact'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
     }
     function get_clinic_by_user_id($clinic_id){
        return $this->db->query("SELECT * FROM clinics WHERE user_id = ?", array($clinic_id))->row_array();
     }
     function get_clinic_by_user_id2($clinic_id){
        return $this->db->query("SELECT id FROM clinics WHERE user_id = ?", array($clinic_id))->row_array();
     }
     function delete_bookmark($bookmark_id){
         return $this->db->delete("bookmarks", array('id' => $bookmark_id));
     }
     function add_user($user)
     {
         $query = "INSERT INTO users(first_name, last_name, email, password, salt, type, is_verified, code, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)";
         $values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], 
            $user['salt'], $user['type'], 0, $user['code'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
     }

     function login_user($email){
        return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
     }
     function get_id_by_email($email){
        return $this->db->query("SELECT id FROM users WHERE email = ?",$email)->row()->id;
     }
     function get_password($email){
        return $this->db->query("SELECT password FROM users WHERE email = ?", $email)->row()->password;
    }
    function get_salt($email){
       return $this->db->query("SELECT salt FROM users WHERE email = ?", $email)->row()->salt;
    }
    function get_type($email){
        return $this->db->query("SELECT type FROM users WHERE email = ?", $email)->row()->type;
    }
    function add_photo($user){
        // $query = "UPDATE users SET path = ?, updated_at = ? WHERE id = {$user['id']}";
        $query = "UPDATE users SET path = ?, updated_at = ? WHERE id = ?";
        $values = array($user['file_name'], date("Y-m-d H:i:s"), $user['id']);
        return $this->db->query($query, $values);
    }
    function add_picture($user){
        $query = "INSERT INTO images(user_id, path, image_name, type, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array($user['user_id'], $user['path'], $user['image_name'], $user['type'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        return $this->db->query($query, $values);
    }
    // upload picture of pet
    function add_pet_picture($pet){
        $pet = $pet;
        $this->update_pet_pic($pet);
        $query = "INSERT INTO images(user_id, pet_id, path, image_name, type, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array($pet['user_id'], $pet['pet_id'], $pet['path'], $pet['image_name'], $pet['type'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        return $this->db->query($query, $values);
    }
    function get_profile_picture($user){
        return $this->db->query("SELECT * FROM images WHERE user_id = {$user['user_id']} AND type = 'profile' AND created_at = (SELECT MAX(created_at) from images WHERE user_id = {$user['user_id']} AND type = 'profile')")->row();
    }
    function get_pet_profile_picture($pet){
        return $this->db->query("SELECT t1.* FROM images t1 WHERE t1.created_at = (SELECT MAX(t2.created_at) FROM images t2 WHERE t2.pet_id = t1.pet_id) AND t1.user_id = {$pet['user_id']}")->result_array();
    }
    function add_pet($data){
        $query = "INSERT INTO pets(user_id, name, type, breed, status, gender,description, weight, birthdate, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
         $values = array($data['user_id'], $data['pet-name'], $data['type'], $data['breed'], 0,
            $data['gender'], $data['description'], 0, $data['birth'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
    }
    function get_pets_of_users_by_id($id)
     {
        return $this->db->query("SELECT *,DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS year, TIMESTAMPDIFF( MONTH, birthdate, now() ) % 12 as month FROM pets WHERE user_id = ?", array($id))->result_array();
     }
     function get_pets_by_id($id){
         return $this->db->query("SELECT * FROM pets WHERE id = ?", array($id))->row_array();
     }
    //  update pet here
    function update_pet($pet){
        if($pet['description'] == "" || $pet['description'] == NULL){
            $data = array(
                'name' => $pet['pet-name'],
                'type' => $pet['type'],
                'breed' => $pet['breed'],
                'birthdate' => $pet['birth'],
                'gender' => $pet['gender'],
                'updated_at' =>  date("Y-m-d H:i:s")
            );
        }else{
            $data = array(
                'name' => $pet['pet-name'],
                'type' => $pet['type'],
                'breed' => $pet['breed'],
                'gender' => $pet['gender'],
                'description' => $pet['description'],
                'birthdate' => $pet['birth'],
                'updated_at' =>  date("Y-m-d H:i:s")
            );
        }
        $this->db->where('id', $pet['id']);
        $this->db->update('pets', $data);
     }
     function update_pet_pic($pet){
         $data = array(
             'photo' => $pet['image_name']
         );
        $this->db->where('id', $pet['pet_id']);
        $this->db->update('pets', $data);
     }

     function get_code($email){
        return $this->db->query("SELECT code FROM users WHERE email = ?", $email)->row()->code;
     }

     function update_code($email){
        $data = array(
            'code' => mt_rand(1111,9999)
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
     }
     function update_status($email){
        $data = array(
            'is_verified' => '1'
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
     }
     function get_verify($email){
        return $this->db->query("SELECT is_verified FROM users WHERE email = ?", $email)->row()->is_verified;
     }

     function update_clinic($clinic){
        $data = array(
            'clinic_name' => $clinic['name'],
            'country' => $clinic['country'],
            'unit_number' => $clinic['unit_number'],
            'street' => $clinic['street'],
            'municipality' => $clinic['municipality'],
            'city' => $clinic['city'],
            'telephone' => $clinic['telephone'],
            'contact_number' => $clinic['contact'],
            'schedule' => $clinic['schedule'],
            'monday_opening' => $clinic['mondayopening'],
            'monday_closing' => $clinic['mondayclosing'],
            'tuesday_opening' => $clinic['tuesdayopening'],
            'tuesday_closing' => $clinic['tuesdayclosing'],
            'wednesday_opening' => $clinic['wednesdayopening'],
            'wednesday_closing' => $clinic['wednesdayclosing'],
            'thursday_opening' => $clinic['thursdayopening'],
            'thursday_closing' => $clinic['thursdayclosing'],
            'friday_opening' => $clinic['fridayopening'],
            'friday_closing' => $clinic['fridayclosing'],
            'saturday_opening' => $clinic['saturdayopening'],
            'saturday_closing' => $clinic['saturdayclosing'],
            'sunday_opening' => $clinic['sundayopening'],
            'sunday_closing' => $clinic['sundayclosing'],
            'updated_at' => date("Y-m-d H:i:s"),
        );
        $this->db->where('user_id', $clinic['user_id']);
        $this->db->update('clinics', $data);
     }

     function add_service($clinic){
        $query = "INSERT INTO services(name, clinic_id, hour, minute, price, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
         $values = array($clinic['name'], $clinic['clinic_id'], $clinic['hour'], $clinic['minute'], 
            $clinic['price'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
     }

     function get_all_services_via_clinic_id($clinic_id){
        return $this->db->query("SELECT * FROM services WHERE clinic_id = ?", array($clinic_id))->result_array();
     }

     function update_service($clinic){
        $data = array(
            'name' => $clinic['name'],
            'hour' => $clinic['hour'],
            'minute' => $clinic['minute'],
            'price' => $clinic['price'],
        );
        $this->db->where('id', $clinic['id']);
        $this->db->update('services', $data);
     }

     function get_all_products_via_clinic_id($clinic_id){
        return $this->db->query("SELECT * FROM products WHERE clinic_id = ?", array($clinic_id))->result_array();
     }

     function add_product($product){
        $query = "INSERT INTO products(clinic_id, product_name, brand, price, quantity, description, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
         $values = array($product['clinic_id'], $product['product_name'], $product['brand'], $product['price'], 
            $product['quantity'], $product['description'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
     }

     function update_product_by_id($product){
        $data = array(
            'product_name' => $product['product_name'],
            'brand' => $product['brand'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
            'description' => $product['description']
        );
        $this->db->where('id', $product['id']);
        $this->db->update('products', $data);
     }

    function update_product_pic($product){
        $data = array(
            'image' => $product['image'],
            'updated_at' => date("Y-m-d H:i:s")
        );
       $this->db->where('id', $product['id']);
       $this->db->update('products', $data);
    }

    function add_user_via_clinic_owner($user)
    {
        $query = "INSERT INTO users(first_name, last_name, email, password, salt, type, is_verified, code, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], 
           12345, $user['role'], 1, 0000, date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
    }

    function add_employee($employee){
        $query = "INSERT INTO employees(user_id, clinic_id, name, email, role, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
         $values = array($employee['user_id'], $employee['clinic_id'], $employee['name'], $employee['email'], $employee['role'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
    }

    function get_all_employees($user_id){
        return $this->db->query("SELECT * FROM employees WHERE user_id = ?", array($user_id))->result_array();
    }

    function update_employee_by_id($employee){
        $data = array(
            'role' => $employee['role'],
            'updated_at' => date("Y-m-d H:i:s")
        );
       $this->db->where('id', $employee['id']);
       $this->db->update('employees', $data);
    }

    function update_users_table_role_type($user){
        $data = array(
            'type' => $user['type'],
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->db->where('email', $user['email']);
        $this->db->update('users', $data);
    }
    function get_user_id_for_show_clinic($id){
        return $this->db->query("SELECT user_id FROM clinics WHERE id = ?", $id)->row()->user_id;
    }

    function get_email_for_session_in_show_clinic($id){
        return $this->db->query("SELECT users.email FROM clinics LEFT JOIN users ON users.id = clinics.user_id WHERE clinics.user_id = ?", $id)->row()->email;
    }
    function get_schedule($id){
        return $this->db->query("SELECT schedule from CLINICS WHERE id = ?", $id)->row()->schedule;
    }
    function add_appointment($appointment){
        $query = "INSERT INTO appointments(user_id, clinic_id, pet_id, name, date, time, pet, text, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)";
         $values = array($appointment['user_id'], $appointment['clinic_id'], $appointment['pet_id'], $appointment['name'], $appointment['date'], $appointment['time'], 
            $appointment['pet'], $appointment['note'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
         return $this->db->query($query, $values);
    }

    function add_order($order){
        $query = "INSERT INTO orders(user_id, clinic_id, product_id, name, product, price, image, quantity, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $values = array($order['user_id'], $order['clinic_id'], $order['product_id'], $order['name'], 
            $order['product'], $order['price'], $order['image'], $order['quantity'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
    }

    function update_quantity($order){
        $data = array(
            'quantity' => $order['quantity'],
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $order['id']);
        $this->db->update('products', $data);
    }

    function show_order_by_user_id($user_id){
        return $this->db->query("SELECT * FROM orders WHERE user_id = ? AND is_paid is null", $user_id)->result_array();
    }

    function load_image($id){
        return $this->db->query("SELECT image FROM products WHERE id = ?", $id)->row()->image;
    }

    function calculate_order($id){
        // return $this->db->query("SELECT SUM(price) as total from orders WHERE id in (?)", str_replace('"', '', implode(',', $id)))->row_array();
        return $this->db->query("SELECT SUM(price) as total from orders WHERE find_in_set(id, ?)", implode(',', $id))->row_array();
    }

    function get_selected_items($id){
        return $this->db->query("SELECT product_id, product, price, id from orders WHERE find_in_set(id, ?)", implode(',', $id))->result_array();
    }
    function get_selected_items_id($id){
        return $this->db->query("SELECT id from orders WHERE find_in_set(id, ?)", implode(',', $id))->result_array();
    }
    function get_product_id($id){
        return $this->db->query("SELECT product_id from orders WHERE find_in_set(id, ?)", implode(',', $id))->row_array();
    }
    function update_status_of_order($dataa){
        $data = array(
            'is_paid' => $dataa['is_paid'],
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->db->where_in('id', implode(',', $dataa['id']));
        $this->db->update('orders', $data);
    }

    function get_paid_orders($user_id){
        return $this->db->query("SELECT * from orders WHERE is_paid = 'ye' AND user_id = ?", $user_id)->result_array();
    }

    function get_appointments($user_id){
        return $this->db->query("SELECT appointments.*, clinics.clinic_name FROM appointments LEFT JOIN clinics ON clinics.id = appointments.clinic_id WHERE appointments.user_id = ?", $user_id)->result_array();
    }

    function get_date_only_for_calendars($user_id){
        return $this->db->query("SELECT appointments.date FROM appointments INNER JOIN clinics ON clinics.id = appointments.clinic_id WHERE appointments.user_id = ?", $user_id)->result_array();
    }

    function delete_service($service_id){
        return $this->db->delete('services', array('id' => $service_id));
    }

    function upload_picture_for_clinic($id){
        $data = array(
            'image' => $id['image'],
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $id['id']);
        $this->db->update('clinics', $data);
    }

    function get_clinic_by_id_frontdesk_by_email($email)
     {
         return $this->db->query("SELECT * FROM employees WHERE email = ?", array($email))->row_array();
     }

     function insert_payment($payment){
        $query = "INSERT INTO payments(user_id, order_id, product_id, clinic_id, courier, amount_paid, name, email_of_buyer, line1, line2, municipality, zip, phone_number_of_buyer, note_for_clinic, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $values = array($payment['user_id'], $payment['order_id'], $payment['product_id'], $payment['clinic_id'], $payment['courier'], $payment['amount'], $payment['name'], $payment['email'], $payment['line1'], $payment['line2'], $payment['municipality'], $payment['postal_code'], $payment['phone'], $payment['description'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
     }

     function get_appointments_for_frontdesk($user_id){
        return $this->db->query("SELECT name, date, time, pet, text FROM appointments WHERE clinic_id= ?", $user_id)->result_array();
    }

    function get_amount_paid_by_clinic_id($clinic_id){
        return $this->db->query("SELECT products.id, products.product_name, SUM(payments.amount_paid) as amount_paid FROM `products` LEFT JOIN payments ON payments.product_id = products.id WHERE payments.clinic_id = ?  GROUP BY products.id ORDER BY amount_paid", $clinic_id)->result_array();
    }

    function get_monthly_sales($clinic_id){
        return $this->db->query("SELECT month(payments.created_at) AS month, SUM(amount_paid) as sale FROM `products` LEFT JOIN payments ON payments.product_id = products.id WHERE payments.clinic_id = ? AND MONTH(payments.created_at) = MONTH(CURRENT_DATE()) GROUP BY month ORDER BY month", $clinic_id)->row_array();
    }
    function get_yearly_sales($clinic_id){
        return $this->db->query("SELECT year(payments.created_at) AS year, SUM(amount_paid) as sale FROM `products` LEFT JOIN payments ON payments.product_id = products.id WHERE payments.clinic_id = ? AND YEAR(payments.created_at) = YEAR(CURRENT_DATE()) GROUP BY year ORDER BY year", $clinic_id)->row_array();
    }
    function get_count_of_items($clinic_id){
        return $this->db->query("SELECT product_id, COUNT(product_id) AS count, product FROM `orders` WHERE clinic_id = ? GROUP BY product_id ORDER BY product", $clinic_id)->result_array();
    }
    function get_appointment($user_id){
        return $this->db->query("SELECT * FROM appointments WHERE clinic_id= ?", $user_id)->result_array();
    }

    function insert_medical_history($data){
        $query = "INSERT INTO histories(pet_id, title, comments, created_at, updated_at) VALUES (?,?,?,?,?)";

        $values = array($data['pet_id'], $data['title'], $data['comments'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
    }
    // function update_status_for_appointment(){
    //     $data = array(
    //         'quantity' => $order['quantity'],
    //         'updated_at' => date("Y-m-d H:i:s")
    //     );
    //     $this->db->where('id', $order['id']);
    //     $this->db->update('products', $data); SELECT pets.name, histories.* FROM `pets` LEFT JOIN histories ON histories.pet_id = pets.id WHERE pets.user_id = 16
    // }

    function load_pet_history($user_id){
        return $this->db->query("SELECT pets.name, histories.* FROM `pets` LEFT JOIN histories ON histories.pet_id = pets.id WHERE pets.user_id = ?", 
        $user_id)->result_array();
    }
    
}