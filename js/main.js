
function changeEvent() {
    var newvalue = document.getElementById("launch-provider").value;

    // Get launches and update launches div
    $.ajax({
        url: 'ajax/launches.php',
        data: {provider: newvalue},
        type: 'post',
        success: function(output) {
            var launchdiv = document.getElementById("launches");
            launchdiv.innerHTML = output;
        }
    });

    // Update detils
    $.ajax({
        url: 'ajax/details.php',
        data: {provider: newvalue},
        type: 'post',
        success: function(output) {
            var detaildiv = document.getElementById("details");
            detaildiv.innerHTML = output;
        }
    });
}
