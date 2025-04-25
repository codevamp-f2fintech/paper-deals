<?php
include('../connection/config.php');

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Modify the query based on the selected category
    $query = "SELECT product_new.*, product_new.id as p_id, product_new.seller_id as s_id, spot_price.*, users.name 
              FROM product_new 
              LEFT JOIN spot_price ON spot_price.product_id = product_new.id 
              LEFT JOIN users ON users.id = product_new.seller_id 
              WHERE product_new.seller_id = '$category' 
              ORDER BY spot_price.id DESC";
              
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $j = 1;
        foreach ($query_run as $prod_item) {
            $s_id = $prod_item['s_id'];
            $sql = "SELECT * FROM `organization` WHERE user_id = '$s_id'";
            $org_query = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($org_query);

            echo "
                <tr>
                    <td>{$j}</td>
                    <td>{$prod_item['product_name']}</td>
                    <td>{$data['organizations']}</td>
                    <td>{$prod_item['shade']}</td>
                    <td>{$prod_item['gsm']}</td>
                    <td>{$prod_item['size']}</td>
                    <td>{$prod_item['weight']}</td>
                    <td>{$prod_item['stock_in_kg']}</td>
                    <td>{$prod_item['price_per_kg']}</td>
                    <td>{$prod_item['quantity_in_kg']}</td>
                    <td>
                        <div class='form-check center-form'>
                            <form id='checkboxForm'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' value='{$prod_item['p_id']}' id='check' " . ($prod_item['created_at'] ? 'checked' : '') . ">
                                    <label class='form-check-label text-white' for='check'></label>
                                </div>
                            </form>
                        </div>
                    </td>
                    <td>{$prod_item['created_at']}</td>
                </tr>
            ";
            $j++;
        }
    } else {
        echo "<tr><td colspan='12'>No records found</td></tr>";
    }
}
?>
