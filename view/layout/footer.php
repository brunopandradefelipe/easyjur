<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.mask.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>

<script>
    $('#button-logout').click(function() {
        console.log('clicou')
        $.ajax({
            type: "POST",
            url: "../routes/apiusers.php?type=logout",
            processData: false,
            contentType: false,
            success: (response) => {
                console.log(response)
                let data = JSON.parse(JSON.stringify(response))
                if (data.status == '200') {
                    Swal.fire({
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                        title: data.message
                    })
                    setTimeout(
                        function() {
                            window.location.href = "singin.php";
                        }, 2000);
                } else {
                    Swal.fire({
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 3000,
                        title: data.message
                    })
                }
            },
            error: (response) => {
                if (response.responseJSON.status == 401) {
                    $('#msmError').css('display', 'block');
                    $('#msmError').html(response.responseJSON.message);
                }
            }
        })
    })
</script>