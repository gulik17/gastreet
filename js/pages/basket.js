$().ready(function () {
    function getDiscountCodes() {
        var userCodesPairs = '';
        $('.discount-code').each(function () {
            var getUserId = $(this).attr('id').split('discount-code-').join('');
            var getCode = $('#discount-code-' + getUserId).val();
            userCodesPairs = userCodesPairs + getUserId + ":" + getCode + "|";
        });
        userCodesPairs = userCodesPairs.split('&').join('').split('=').join('');
        return userCodesPairs;
    }
    $('.discount-code-button').click(function () {
        var btn = $(this);
        if ( !btn.hasClass('disabled') ) {
            btn.addClass('disabled');
            var goUrl = "/ajax?job=applybasketdiscount";
            var getUserId = $(this).attr('id').split('discount-code-button-').join('');
            var getCode = $('#discount-code-' + getUserId).val();
            var gotdata = '&code=' + getCode + '&user=' + getUserId;
            $.ajax({ 
                type: 'POST',
                dataType: 'JSON',
                url: goUrl,
                data: gotdata,
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                        return false;
                    } else {
                        if (data == 'refreshbasket') {
                            alert("Вам была предоставлена скидка");
                            window.location.reload();
                        } else {
                            alert("Код не был применен");
                            btn.removeClass('disabled');
                        }
                    }
                }
            });
        }
        return false;
    });
    $('#basket-total-pay').click(function (evt) {
        evt.preventDefault();
        var total = $('#basket-total-pay').data('total');
        var goUrl = "/index.php?do=payment&total=" + total;
        var code = $('#code').val();
        if (code) {
            goUrl = goUrl + '&code=' + code;
        }
        var codes = getDiscountCodes();
        if (codes) {
            goUrl = goUrl + '&codes=' + codes;
        }
        window.location.href = goUrl;
        return false;
    });
    $('#basket-balance-pay').click(function (evt) {
        evt.preventDefault();
        var goUrl = "/index.php?do=paybalance";
        var code = $('#code').val();
        if (code) {
            goUrl = goUrl + '&code=' + code;
        }
        var codes = getDiscountCodes();
        if (codes) {
            goUrl = goUrl + '&codes=' + codes;
        }
        window.location.href = goUrl;
        return false;
    });
    $('#basket-total-invoice').click(function (evt) {
        evt.preventDefault();
        var classContent = $('#basket-total-invoice').attr('class').split('baskettotalamount-').join('');
        var goUrl = "/index.php?show=invoice&total=" + classContent;
        var code = $('#code').val();
        if (code) {
            goUrl = goUrl + '&code=' + code;
        }
        var codes = getDiscountCodes();
        if (codes) {
            goUrl = goUrl + '&codes=' + codes;
        }
        window.location.href = goUrl;
        return false;
    });
    $('#basket-purchase-more').click(function (evt) {
        evt.preventDefault();
        window.location.href = "/index.php?show=catalog";
        return false;
    });
    $('#basket-balance-add').click(function (evt) {
        evt.preventDefault();
        window.location.href = "/index.php?show=addbalance";
        return false;
    });
    $('#basket-book').click(function (evt) {
        evt.preventDefault();
        window.location.href = "/index.php?show=booking";
        return false;
    });
    $('.basket-purchase-user').click(function (evt) {
        evt.preventDefault();
        var classContent = $(this).attr('id').split('basket-purchase-user-').join('');
        window.location.href = "/index.php?do=relogin&id=" + classContent;
        return false;
    });
    $('.basket-purchase-actor').click(function (evt) {
        evt.preventDefault();
        window.location.href = "/index.php?do=reloginactor";
        return false;
    });
    $('.js-spoiler-head').each(function(){
        var $basketline = $(this);
        $basketline.click();
    });
    
    var timeinterval;

    function getTimeRemaining(endtime) {
        var t = endtime;
        var seconds = Math.floor( (t) % 60 );
        var minutes = Math.floor( (t/60) % 60 );
        if (seconds < 10) {
            seconds = '0'+seconds;
        }
        return {
            'total': t,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeTest(id, endtime){
        var clock = document.getElementById(id);
        timeinterval = setInterval(function(){
            var t = getTimeRemaining(endtime);
            clock.innerHTML = t.minutes + ':' + t.seconds;
            endtime--;
            if(t.total <= 0){
                clearInterval(timeinterval);
                alert('Время вышло! Тест не сдан');
                location.reload();
            }
        }, 1000);
    }

    if ($('a[data-target="#testModal"]').length > 0) {
        var modalTest = '<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel" aria-hidden="true">'
            +'<div class="modal-dialog" role="document">'
            +'<div class="modal-content">'
            +'<div class="modal-header">'
            +'<h5 class="modal-title">ЧЕМПИОНАТ ПО ПИЦЦЕ</h5>'
            +'<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>'
            +'</div>'
            +'<div class="modal-body pl-4 pr-4 text-center">'
            +'<p><b>Внимание!</b><br>Если вы закроете страницу, не ответив на все вопросы теста, тест будет считаться <span class="text-danger">не пройденным</span>.</p>'
            +'<p class="fs16">Тест состоит из 7 вопросов.<br> Время прохождения теста 5 минут.</p>'
            +'<button type="button" class="btn btn-success mt-3 mb-3 start-test">Начать тест</button>'
            +'</div>'
            +'<div class="modal-footer d-none">'
            +'<span class="test-time" id="clockdiv">5:00</span><span class="test-step">1 / 7</span><a href="#" class="btn btn-link" data-ans="1">Ответить →</a>'
            +'</div>'
            +'</div>'
            +'</div>'
            +'</div>';

        $('body').append(modalTest);

        var q = ['', '', '', '', '', '', '', ''];
        var q_yes = '<h4 class="mb-1 text-success">Вы успешно прошли тест</h4>';
        var q_no = '<h4 class="mb-1 text-danger">Вы не прошли тест</h4>';
        q[1] = '<h5 class="mb-1">Как правильно добавить дрожжи?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) Развести их в воде и соли</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> б) Добавить в муку и тестомес</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> в) Растворить в теплой воде</div>';
        q[2] = '<h5 class="mb-1">До какой температуры должна быть разогрета духовка?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) 220°</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> б) 320°</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> в) 380°</div>';
        q[3] = '<h5 class="mb-1">Какой сорт/сорта муки используются для приготовления «римской пиццы»?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) Твердые сорта</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> б) Рисовая мука</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> в) Соевая, рисовая и пшеничная</div>';
        q[4] = '<h5 class="mb-1">В какой момент нужно добавлять в тесто оливковое масло?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) Не имеет значения</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> б) Вместе с водой</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> в) В самом конце</div>';
        q[5] = '<h5 class="mb-1">Правильная моцарелла для «неаполитанской пиццы» – какая?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) Плавленная</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> б) Не имеет значения</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> в) Свежая</div>';
        q[6] = '<h5 class="mb-1">За счет чего тесто становится хрустящим?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) Температуры печи</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> б) Правильной закваски</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> в) Способа приготовления: в печи на дровах, в газовой или электрической духовой печи.</div>';
        q[7] = '<h5 class="mb-1">Какая температура должна быть у готового теста?</h5>'+
            '<div class="answer"><input name="a" value="value1" type="radio" /> а) 18°</div>'+
            '<div class="answer"><input name="a" value="value2" type="radio" /> б) 23°</div>'+
            '<div class="answer"><input name="a" value="value3" type="radio" /> в) 30°</div>';

        $('.start-test').on('click', function() {
            $.post("/ajax", {job: "start_test"}, function(data) {
                if (data['error'] === 0) {
                    $('#testModal .modal-body').html(q[1]);
                    $('#testModal .modal-body').removeClass('text-center');
                    $('#testModal .modal-footer').removeClass('d-none');
                    initializeTest('clockdiv', 300);
                } else {
                    $.alert(data['msg'], {title: false, type: 'danger',onClose: function () {
                        $('#testModal').modal('hide');
                    }});
                    //location.reload();
                }
            },"json");
            return false;
        });

        var yes = 0;
        $('#testModal a[data-ans]').on('click', function() {
            var btn_ans = $(this).data('ans');
            var a = $('#testModal .answer input:checked');
            if (btn_ans < 7) {
                if (a.val()) {
                    if (a.val() === 'value2') {
                        yes++;
                    }
                    btn_ans++;
                    $('#testModal .test-step').html(btn_ans+' / 7');
                    $('#testModal .modal-body').html(q[btn_ans]);
                    $(this).data('ans', btn_ans);
                } else {
                    alert('Выберите вариант ответа');
                }
            } else {
                if (a.val()) {
                    if (a.val() === 'value2') {
                        yes++;
                    }
                    clearInterval(timeinterval);
                    $('#testModal .modal-footer').addClass('d-none');
                    if (yes >= 5) {
                        $.post("/ajax", {job: "finish_test"}, function(data) {
                            if (data['error'] === 0) {
                                $('#testModal .modal-body').html(q_yes+'<p>Правильных ответов: '+yes+'</p>');
                            } else {
                                $.alert(data['msg'], {title: false, type: 'danger',onClose: function () {
                                    $('#testModal').modal('hide');
                                }});
                                //location.reload();
                            }
                        },"json");
                    } else {
                        $('#testModal .modal-body').html(q_no+'<p>Правильных ответов: '+yes+'</p>');
                    }
                } else {
                    alert('Выберите вариант ответа');
                }
            }
            return false;
        });
        $('#testModal').on('hidden.bs.modal', function() {
            location.reload();
        });
    }
});