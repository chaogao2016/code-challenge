$(".select-on-check-all").click(function (){
    var curNode = $(".select-on-check-all")[0]
    if (curNode.checked) {
        console.log("select check-all")
        $("#checkAll-Modal").modal("show")
    } else {
        console.log("unselect check-all")
        $("#checkAll-Modal").modal("hide")
    }
})

$("#checkAll-yes").click(function (){
    console.log("click checkAll-yes")
    $("#checkAll-input").val(1)
    $("#checkAll-Modal").modal("hide")
    $("#checkSelect-Modal").modal("show")
})

$("#checkSelect-yes").click(function (){
    console.log("click checkSelect-yes")
    $("#checkAll-input").val(0)
    $("#checkSelect-Modal").modal("hide")
})

$(".export-btn").click(function (){
    var keys = $("#supplier-grid").yiiGridView("getSelectedRows");
    console.log(keys);
    $("#supplier-form").submit()
    return
})