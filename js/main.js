
function changeEvent() {
    var newvalue = document.getElementById("launch-provider").value;


    $.ajax({
        url: 'ajax/launches.php',
        data: {provider: newvalue},
        type: 'post',
        success: function(output) {
            var launchdiv = document.getElementById("launches");
            launchdiv.innerHTML = output;
        }
    });
}
