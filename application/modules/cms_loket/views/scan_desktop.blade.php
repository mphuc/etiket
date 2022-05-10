<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
$CI = &get_instance();
$errmsg = $CI->session->flashdata('errmsg');
$successmsg = $CI->session->flashdata('successmsg');
?>
<style media="screen">
.btn-md {
    padding: 1rem 2.4rem;
    font-size: .94rem;
    display: none;
}
.swal2-popup {
    font-family: inherit;
    font-size: 1.2rem;}

.wadah {
  display: flex;
  justify-content: center;
}
</style>

<div class="container-lg mt-3">
      @php
          $CI = &get_instance();
          if($CI->session->flashdata('successmsg')){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' align='center'>
              <strong>".$CI->session->flashdata('successmsg')."</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
          else if($CI->session->flashdata('errmsg')){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
              <strong>".$CI->session->flashdata('errmsg')."</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
      @endphp
    </div>

<section class='content' id="demo-content">
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <div class="wadah">
                    <h2><b> Scan QR untuk masuk.</b></h2>
                    </div>
                </div>
                <div class='box-body'>
                    <?php
                    $attributes = array('id' => 'buttonx');
                    echo form_open('cms/loket/cek_id',$attributes);?>
                    <div id="sourceSelectPanel" style="display:none">
                        <label for="sourceSelect">Change video source:</label>
                        <select id="sourceSelect" style="max-width:400px"></select>
                    </div>
                    <div class="wadah">
                        <video id="video" width="800" height="600" style="border: 1px solid gray"></video>
                    </div>
                    <textarea hidden="" name="ticket_code" id="result" readonly></textarea>
                    <span>  <input type="submit"  id="buttonx" class="btn btn-success btn-md" value="Cek tiket"></span>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/zxing/zxing.min.js"></script>
<script type="text/javascript">
window.addEventListener('load', function () {
    let selectedDeviceId;
    let audio = new Audio("<?php echo base_url()?>assets/audio/beep.mp3");
    const codeReader = new ZXing.BrowserQRCodeReader()
    console.log('ZXing code reader initialized')
    codeReader.getVideoInputDevices()
    .then((videoInputDevices) => {
        const sourceSelect = document.getElementById('sourceSelect')
        selectedDeviceId = videoInputDevices[0].deviceId
        if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
                const sourceOption = document.createElement('option')
                sourceOption.text = element.label
                sourceOption.value = element.deviceId
                sourceSelect.appendChild(sourceOption)
            })
            sourceSelect.onchange = () => {
                selectedDeviceId = sourceSelect.value;
            };
            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
        }
        codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
            console.log(result)
            document.getElementById('result').textContent = result.text
            if(result != null){
                audio.play();
            }
            $('#buttonx').submit();
        }).catch((err) => {
            console.error(err)
            document.getElementById('result').textContent = err
        })
        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
    })
    .catch((err) => {
        console.error(err)
    })
})
</script>
<?php

		if ($errmsg != "")
		{
			if ($successmsg == 1) $shortCutFunction = "success";
			else $shortCutFunction = "error"; ?>

			<script type="text/javascript" language="javascript">
				var UIToastr = function () {

					return {
						//main function to initiate the module
						init: function () {

							var i = -1,
								toastCount = 0,
								$toastlast,
								getMessage = function () {
									var msgs = ['Hello, some notification sample goes here',
										'<div><input class="form-control input-small" value="textbox"/>&nbsp;<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">Check this out</a></div><div><button type="button" id="okBtn" class="btn blue">Close me</button><button type="button" id="surpriseBtn" class="btn default" style="margin: 0 8px 0 8px">Surprise me</button></div>',
										'Did you like this one ? :)',
										'Totally Awesome!!!',
										'Yeah, this is the Metronic!',
										'Explore the power of App. Purchase it now!'
									];
									i++;
									if (i === msgs.length) {
										i = 0;
									}

									return msgs[i];
								};

							var shortCutFunction = "<?php echo $shortCutFunction; ?>";
							var msg = "<?php echo $errmsg; ?>";
							var title = '';
							var toastIndex = toastCount++;

							toastr.options = {
								closeButton: 'checked',
								debug: $('#debugInfo').prop('checked'),
								positionClass: 'toast-top-center',
								onclick: null
							};

							if (!msg) {
								msg = getMessage();
							}

							$("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));

							var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
							$toastlast = $toast;
							if ($toast.find('#okBtn').length) {
								$toast.delegate('#okBtn', 'click', function () {
									alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
									$toast.remove();
								});
							}
							if ($toast.find('#surpriseBtn').length) {
								$toast.delegate('#surpriseBtn', 'click', function () {
									alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
								});
							}

							$('#clearlasttoast').click(function () {
								toastr.clear($toastlast);
							});

							$('#cleartoasts').click(function () {
								toastr.clear();
							});

						}

					};

				}();

				jQuery(document).ready(function() {
				   UIToastr.init();
				});
			</script><?php
		} ?>
