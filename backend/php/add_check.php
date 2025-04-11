<?php 

if (isset($_POST['order'])) {

    $user_id = $_POST['pdrus'];
    $idpa = $_POST['idpa'];
    $method = $_POST['cxtcre'];
    $placed_on = date('d-M-Y');
    $tipc = $_POST['cxcom'];
    $id_consul = $_POST['id_consul'];

    $cart_total = 0;
    $cart_products = [];

    // Consulta para obtener los productos en el carrito
    $cart_query = $connect->prepare("SELECT cart.idv, users.id, users.username, users.name, product.nompro, product.idprcd, product.codpro, product.preprd, product.stock, cart.name, cart.price, cart.quantity 
        FROM cart  
        INNER JOIN users ON cart.user_id = users.id 
        INNER JOIN product ON cart.idprcd = product.idprcd 
        WHERE user_id = ?");
    $cart_query->execute([$user_id]);

    if ($cart_query->rowCount() > 0) {
        while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
            $cart_products[] = $cart_item['name'] . ' ( ' . $cart_item['quantity'] . ' )';
            $sub_total = ($cart_item['preprd'] * $cart_item['quantity']);
            $cart_total += $sub_total;

            // Verificar si hay suficiente stock antes de realizar la operación
            if ($cart_item['stock'] >= $cart_item['quantity']) {
                // Actualizar el stock del producto
                $update_stock = $connect->prepare("UPDATE product SET stock = stock - ? WHERE idprcd = ?");
                $update_stock->execute([$cart_item['quantity'], $cart_item['idprcd']]);
            } else {
                echo '<script type="text/javascript">
                swal("Error!", "Stock insuficiente para el producto ' . $cart_item['nompro'] . '", "error").then(function() {
                    window.location = "../medicinas/cart.php";
                });
                </script>';
                exit(0); // Detener el proceso si el stock es insuficiente
            }
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = $connect->prepare("SELECT * FROM `orders` WHERE method = ? AND total_products = ? AND total_price = ? AND tipc = ? AND id_consulta = ?");
    $order_query->execute([$method, $total_products, $cart_total, $tipc, $id_consul]);

    if ($cart_total == 0) {
        echo '<script type="text/javascript">
        swal("Carrito vacío", "No hay productos para procesar", "warning").then(function() {
            window.location = "../medicinas/cart.php";
        });
        </script>';
    } elseif ($order_query->rowCount() > 0) {
        echo '<script type="text/javascript">
        swal("Pedido duplicado", "Este pedido ya ha sido registrado", "warning").then(function() {
            window.location = "../medicinas/cart.php";
        });
        </script>';
    } else {
        // Insertar el pedido en la tabla `orders`
        $insert_order = $connect->prepare("INSERT INTO `orders`(user_id, idpa, method, total_products, total_price, placed_on, payment_status, tipc, id_consulta) 
            VALUES(?,?,?,?,?,?, 'Aceptado', ?, ?)");
        $insert_order->execute([$user_id, $idpa, $method, $total_products, $cart_total, $placed_on, $tipc, $id_consul]);

        // Vaciar el carrito después de procesar el pedido
        $delete_cart = $connect->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

        echo '<script type="text/javascript">
        swal("¡Registrado!", "Pedido agregado correctamente", "success").then(function() {
            window.location = "../citas/mostrar.php";
        });
        </script>';
    }
}
?>
