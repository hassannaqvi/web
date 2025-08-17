
	<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
            <div class="left">
                <span>&copy; <?php echo date("Y");?>, All Right Reserved</span>
                <div class="bg-left"></div>
            </div>
            </div>
            
            <div class="col-md-4 col-sm-4">
            <div class="right">
                <span style="position:relative; z-index:1;"><a href="#top" class="scroll"><img src="assets/img/arrow-up.svg" alt="" height="20"></a></span>
                <div class="bg-right"></div>
            </div>
            </div>
        </div>
    </div>
    </footer>

</div>
</div>


<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="assets/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>


<!--= Loader =-->
<script>
$( document ).ready(function() {
	if (typeof(window.afterReady) !== 'undefined')
	{
		for(k in window.afterReady)
		{
			try{window.afterReady[k]();}catch(e){fn_include_file(e,window.afterReady[k]);}
		}
	}
	window.afterReady = [];
	setTimeout(function(){
		$('#loader-wrapper').fadeOut('fast');
	}, 3000);
});
</script>


<!--= Form =-->
<script>
document.getElementById("form-contact").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const statusDiv = document.getElementById("form-status");

    fetch(form.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        statusDiv.innerHTML = `<div class="alert ${data.alert}" role="alert">${data.message}</div>`;
        if (data.status === 'success') form.reset();
        setTimeout(() => statusDiv.innerHTML = '', 4000);
    })
    .catch(() => {
        statusDiv.innerHTML = '<div class="alert alert-danger" role="alert">Something went wrong. Please try again later.</div>';
        setTimeout(() => statusDiv.innerHTML = '', 4000);
    });
});
</script>

<style type="text/css">
	#form-status {
		position:fixed;
		top:10px;
		left:10px;
		right:10px;
		z-index:1000;
	}
</style>
<!--= Form =-->

</body>
</html>