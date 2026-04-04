<?php 

    define('ORDER_JSON_PATH', '../json/commandes.json');


    function calculatePrice ($order) {
        // Returns the price of the order
        $price = 0;
        foreach($order as $element) {
            $price += $element['prix'];
        }
        return price;
    }

    function getOrders () : array {
        // Returns all past orders

        if (!file_exists(ORDER_JSON_PATH)) {
            $file = fopen(ORDER_JSON_PATH, 'w');
            fclose($file);
        }

        $data = json_decode(file_get_contents(ORDER_JSON_PATH), true);
        if (!$data) {
            return array();
        }
        return $data;
    }

    
    function createOrder (array $contents, String $type, int $client_id) : void {
        // Writes a new order into the JSON file

        $order = array(
            'contents' => $contents,
            'client_id' => $client_id,
            'type' => $type,    // Sur place, à emporter, etc
            'date' => time(),
            'status' => 0     // 0 = payée, 1 = en préparation, 2 = préparée, 3 = en livraison, 4 = livrée
        );

        $data = getOrders();
        $order['id'] = count($data);

        $data[] = $order;
        file_put_contents(ORDER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
    }


    function deleteOrder (int $order_id) : bool {
        // Deletes the order, returns true if it was successful
        
        $data = getOrders();

        $found = false;
        foreach($data as $index => $order) {
            if ($order['id'] == $order_id) {
                unset($data[$index]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            return false;
        }

        file_put_contents(ORDER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
        return true;
    }


    function updateOrderStatus (int $order_id) : bool {
        // Updates the status of the order, returns true if successful

        $orders = getOrders();

        $found = false;
        foreach($orders as $order) {
            if ($order['id'] == $order_id) {
                $order['status']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            return false;
        }

        file_put_contents(ORDER_JSON_PATH, json_encode($orders, JSON_PRETTY_PRINT));
        return true;
    }

    function ordersByStatus (int $status, String $type = '') : array {
        // Returns all orders with the given status and type, if type == '' returns every order with given status

        $orders = getOrders();

        $requested = array();
        foreach($orders as $order) {
            if ($order['status'] == $status && ($type ? ($order['type'] == $type) : true)) {
                $requested[] = $order;
            }
        }

        return $requested;
    }

    function getUserOrders ($client_id) {
        // Returns all orders of the given client
        
        $orders = getOrders();

        $requested = array();
        foreach($orders as $order) {
            if ($order['client_id'] == $client_id) {
                $requested[] = $order;
            }
        }

        return $requested;

    }

?>