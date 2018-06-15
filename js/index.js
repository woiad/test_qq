$(document).ready(function(){
    var obj = '';
    var bool = '';
    var mess = '';
    var val = '';
    $(".inp").blur(function(){
        val = $(this).val();
        var reg = /^[1-9][0-9]{4,10}$/;
        bool = reg.test(val)
        if (val==='') {
            alert('请输入QQ号码！')
            return false;
        } else if (!bool) {
            alert("输入QQ有误！请重新输入")
        }
    })
    var get_data = function(){
        if (!bool || $(".inp").val === '') {
            return
        } else{
            $.ajax({
                type: 'Get',
                url: 'index.php',
                success: function(data){
                    console.log(data)
                    console.log(typeof data)
                },
                error: function(error){
                    console.log(error)
                }
            })
        }
    };
    var post_data = function(val){
        val = parseInt(val)
        console.log(typeof val);
        $.ajax({
            type: 'POST',
            data: {
                val: val
            },
            url: 'index.php',
            success: function(data){
                console.log(data)
                obj = JSON.parse(data);
                if (obj) {
                    alert('查询成功')
                    console.log(obj)
                    mess = obj.result.data;
                    console.log(mess.analysis)
                    $('.result-title').text(mess.conclusion);
                    $('.result-analys').text(mess.analysis);
                } else{
                    alert('查询失败，请稍后重试')
                }
            },
            error: function(error){
                console.log(error)
            }
        })
    }
    $(".btn").on('click', function(){
        if ($('.inp').val() ==='') {
            alert('请输入QQ号码！')
        } else if (!bool) {
            alert("输入QQ有误！请重新输入")
        } else {
            post_data(val);
            get_data();
        }
    })
})
