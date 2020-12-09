$(document).ready(function(){

    $("button").click(function() {
            var localização = $("#local").val();
            $.post("location&hobbies.php", {
                localização: localização
            }, function (data,status) {
                $("#test").html(data);
        });
    });
});

$(document).ready(function(){

    $("button").click(function() {
            var hobbies = $("#hob").val();
            $.post("location&hobbies.php", {
                hobbies: hobbies
            }, function (data,status) {
                $("#test2").html(data);
        });
    });
});
