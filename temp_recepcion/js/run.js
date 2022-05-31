var alerta= "<?php echo $_SESSION['msg_urgente'];?>"

if (alerta==1) {
    alert("<?php $_SESSION['msg'];?>")
}

