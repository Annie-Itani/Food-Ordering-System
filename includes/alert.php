
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !='') {?>
<script>
iziToast.<?php echo $_SESSION['status']; ?>({
    timeout: 15000,
    iconUrl: '<?php echo $_SESSION['icons']; ?>',
    message: '<?php echo $_SESSION['status_code']; ?>',
    position: 'bottomRight',
});
    </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
        unset($_SESSION['icons']);
    }
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
