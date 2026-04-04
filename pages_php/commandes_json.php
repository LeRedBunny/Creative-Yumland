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


    function getOrdersByStatus (int $status, String $type = '') : array {
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


    function updateOrderStatus (String $id, int $change = 1) : bool {
        // Updates the status of the order, returns true if successful
        // If the order isn't being prepared/delivered, increments its status, else decrements it

        $orders = getOrders();

        $found = false;
        foreach ($orders as $index => $order) {
            if ($order['id'] == $id) {
                $orders[$index]['status'] += $change;
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