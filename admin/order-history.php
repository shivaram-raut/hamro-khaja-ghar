<?php include("../partials/admin-navigation-bar.php"); ?>

<form id="order-details-form" action="order-details.php" method="POST" style="display: none;">
    <input type="hidden" name="form-id" value="order-details-form">
    <input type="hidden" name="user-id" id="user-id">
    <input type="hidden" name="order-id" id="order-id">
    <input type="hidden" name="delivery-adrs" id="delivery-adrs">
    <input type="hidden" name="order-status" id="order-status">
    <input type="hidden" name = "order-date" id="order-date">
    <input type="hidden" name="mode" value="view-only">
</form>

<!-- delete-order-history form starts here -->
 <div class="overlay"></div>
<div class="form delete-form" style="width: 30%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Order</div>
    <div class="confirm-delete-qsn">Delete the order permanently?</div>
    <form action="<?php echo SITEURL.  'admin/delete-order-history.php' ?> " method="post">
        <input type="hidden" name="form-id" value="delete-order-history" />
        <input type="hidden" name="order-id" id="delete-order-id" />

        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "  style="font-size: 18px; padding: 10px;"> Cancel</span>
        <div class="clear-fix"></div>
    </form>
</div>
<!-- delete-order-history form stops here! -->

<div class="container" style="width: 90%; min-height: 65vh;">

     <!--  notification-msg box-->

     <?php if (isset($_SESSION['notification_msg'])): ?>
            <div class="notification-msg">
                <?php echo $_SESSION['notification_msg']; ?>
                <span class="cross cross1">&times;</span>
            </div>
            <script src="../javascript/notification-msg.js"></script>
            <?php unset($_SESSION['notification_msg']); // Clear the message after displaying 
            ?>
        <?php endif; ?>

<div class="page-heading">
    <h2> Order History:</h2>
</div>

<div class="order-table">
    <table class="table-full">
        <tr>
            <th>S.N.</th>
            <th>Order-id</th>
            <th>Total Price</th>
            <th>Time </th>
            <th> Order Status </th>
            <th>Actions</th>
        </tr>

        <!-- Accessing the order-history -->
        <?php
        $sql = "SELECT * FROM tbl_order_history ORDER BY id DESC ";
        $res = mysqli_query($conn, $sql);
        $sn = 1;

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $order_id = $rows['order_id'];
                    $user_id = $rows['user_id'];
                    $customer_name = $rows['customer_name'];
                    $delivery_adrs = $rows['delivery_adrs'];
                    $price = $rows['total_price'];
                    $status = $rows['order_status'];
                    $date = $rows['date'];

        ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $order_id; ?></td>
                        <td><?php echo "Rs. " . number_format($price, 2); ?></td>
                        <td><?php echo date('Y-m-d h:i:s A', strtotime($date)); ?></td>

                        <td>
                            <div>
                                <?php if ($status == "Ordered") : ?>
                                    <span style="color:forestgreen"> <?php echo $status; ?></span>
                                <?php else: ?>
                                    <span style="color:deepskyblue"> <?php echo $status; ?></span>
                                <?php endif; ?>


                            </div>
                        </td>



                        <td style="text-align: left;">
                            <div>
                                <span class="view-details-btn" style=" color: #008fb3;cursor: pointer;margin-right: 10%;" data-user-id="<?php echo $user_id; ?>" data-order-id="<?php echo $order_id; ?>" data-delivery-adrs="<?php echo $delivery_adrs; ?>" data-order-status="<?php echo $status; ?>" data-order-date="<?php echo $date; ?>"> &#128065;View Details</span>

                                <span class="delete-odr-btn" style=" color: red;cursor: pointer;" data-order-id="<?php echo $order_id; ?>"> &#128465;Delete</span>

                            </div>
                        </td>
                    </tr>

        <?php
                }
            }
        }
        ?>
    </table>
</div>
</div>

<?php include("../partials/admin-footer.php"); ?>
<script src="../javascript/order-details-form.js"> </script>
<script src="../javascript/delete-order.js"> </script>

