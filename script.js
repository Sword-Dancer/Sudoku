$(document).ready(function(){

    var construct_btn = $('#construct_mode'),
        pencil_btn = $('#pencil'),
        eraser_btn = $('#erase');

    construct_btn.click(function(){checkerOnOff($(this));});
    pencil_btn.   click(function(){checkerOnOff($(this));});
    eraser_btn.   click(function(){checkerOnOff($(this));});



    /*if ($.cookie('sudoku'))
    {
    	$('#net_wrapper').html($.cookie('sudoku'));
    }

    $(window).unload(function(){
    	$.cookie('sudoku', $('#net').prop('outerHTML'), {expires:365});
    });*/

	/*$('#save').click(function(){

        var net;



        $('#net td').each(function (i, cell) {

            console.log(cell.id);
            console.log(this);

            net[cell.id] = [cell.attr("class")];
            cell.children().each(function (j, num) {
                net[cell.id].push(num.attr("type"));
                net[cell.id].push(num.attr("num"));
            });


        });

        console.log(net);

        //$.cookie('sudoku', $('#net').prop('outerHTML'), {expires:365});
		//alert("zd");
	});

	$('#load').click(function(){
		//$('#net_wrapper').html($.cookie('sudoku'));
	});*/

    $('html').keydown(function(){
       
        var key = event.keyCode;

        var element_codes = {
            49: 'num_1',
            50: 'num_2',
            51: 'num_3',
            52: 'num_4',
            53: 'num_5',
            54: 'num_6',
            55: 'num_7',
            56: 'num_8',
            57: 'num_9',
            67: 'construct_mode',    // c
            32: 'pencil',            // space
            88: 'erase'              // x
        };
        var id_element = (element_codes[key]) ? element_codes[key] : false;
        $("#"+id_element).click();


        var cell_num = parseInt(getCellNum($('.active_cell'))),
            arrow_codes = {
                37: cell_num - 1,   // <-
                38: cell_num - 9,   // верх
                39: cell_num + 1,   // ->
                40: cell_num + 9    // низ
            },
            new_cell = (arrow_codes[key] >= 1 && arrow_codes[key] <= 81) ? arrow_codes[key] : false;
        if (new_cell)
            changeActiveCell(new_cell);


        if (key == 13)
            $('#net').find('.active_cell').click();
    });

	$('#clear').click(function(){
        var select_num_elem = $('.num.on'),
            select_num = exist(select_num_elem) ? getSelectNum(select_num_elem) : false;

        unMarkCell(select_num);
		
		var cell_class = (construct_btn.hasClass('off')) ? ".unlock" : "";
		$('#net').find('td'+cell_class).children().remove();

        markCell(select_num);
    });

    $('.num').click(function(){
        var self = $(this);
        checkerOnOff(self);

        var prev_num_elem = self.siblings('.num.on');
        checkerOnOff(prev_num_elem);

        var prev_num = exist(prev_num_elem) ? getSelectNum(prev_num_elem) : false;
        unMarkCell(prev_num);

        var num = getSelectNum(self);

        if (self.hasClass('on'))
            markCell(num);
        else
            unMarkCell(num);
    });

    $('#net').find('td').click(function(){
        var td = $(this),
            select_num_elem = $('.num.on'),
            select_num = exist(select_num_elem) ? getSelectNum(select_num_elem) : false,

            isConstruct = construct_btn.hasClass('on'),
            isPencil = pencil_btn.hasClass('on'),
            isErase = eraser_btn.hasClass('on'),

            isLockCell = td.hasClass('lock'),

            noBigNum = (!exist(td.children(".big_num"))),
            hasSelectBigNum = exist(td.children("div[type=big_num][num="+select_num+"]")),
            hasSelectSmallNum = exist(td.children("div[type=small_num][num="+select_num+"]"));

        var mode_eraseInConstruct =    (isConstruct && !select_num && isErase),
            mode_eraseNumInConstruct = (isConstruct && select_num  && hasSelectBigNum),
            mode_drawInConstruct =     (isConstruct && select_num  && !isErase && !hasSelectBigNum),

            mode_draw =        (!isConstruct && !isLockCell && !isPencil && select_num  && !isErase && !hasSelectBigNum),
            mode_eraseBigNum = (!isConstruct && !isLockCell && !isPencil && select_num  && hasSelectBigNum),
            mode_erase =       (!isConstruct && !isLockCell && !isPencil && !select_num && isErase),

            mode_erasePencil =   (!isConstruct && !isLockCell && isPencil && !select_num && isErase),
            mode_eraseSmallNum = (!isConstruct && !isLockCell && isPencil && select_num  && hasSelectSmallNum),
            mode_drawSmallNum =  (!isConstruct && !isLockCell && isPencil && select_num  && !isErase && !hasSelectSmallNum && noBigNum);

        var status;
        if (mode_eraseInConstruct)    status = "mode_eraseInConstruct";
        if (mode_eraseNumInConstruct) status = "mode_eraseNumInConstruct";
        if (mode_drawInConstruct)     status = "mode_drawInConstruct";
        if (mode_draw)                status = "mode_draw";
        if (mode_eraseBigNum)         status = "mode_eraseBigNum";
        if (mode_erase)               status = "mode_erase";
        if (mode_erasePencil)         status = "mode_erasePencil";
        if (mode_eraseSmallNum)       status = "mode_eraseSmallNum";
        if (mode_drawSmallNum)        status = "mode_drawSmallNum";

        unMarkCell(select_num);
        changeActiveCell(getCellNum(td));

        switch (status)
        {
            case "mode_eraseInConstruct":
            case "mode_eraseNumInConstruct":
                eraseBigNum(td);
                unLockCell(td);
                break;
            case "mode_drawInConstruct":
                eraseBigNum(td);
                insertBigNum(td, select_num);
                lockCell(td);
                break;
            case "mode_draw":
                erasePencil(td);
                eraseBigNum(td);
                insertBigNum(td, select_num);
                break;
            case "mode_eraseBigNum":
            case "mode_erase":
                eraseBigNum(td);
                break;
            case "mode_erasePencil":
                erasePencil(td);
                break;
            case "mode_eraseSmallNum":
                eraseSmallNum(td, select_num);
                break;
            case "mode_drawSmallNum":
                insertSmallNum(td, select_num);
                break;
            default:
        }

        markCell(select_num);
    });
});


function changeActiveCell(new_cell_pos)
{
    $('.active_cell').removeClass('active_cell');
    $('#cell_' + new_cell_pos).addClass('active_cell');
}


function markCell(num)
{
    var net = $("#net");
    net.find("div[num="+num+"][type=big_num]").parent().addClass('mark_big_num');
    net.find("div[num="+num+"][type=small_num]").parent().addClass('mark_small_num');
}
function unMarkCell(num)
{
    var net = $("#net");
    net.find("div[num="+num+"][type=big_num]").parent().removeClass('mark_big_num');
    net.find("div[num="+num+"][type=small_num]").parent().removeClass('mark_small_num');
}

function insertSmallNum(td, num)
{
    var cell_num = getCellNum(td);
    var small_num = $("<div/>", {
        "class": "small_num",
        "id": 'small_num_' + cell_num + '_' + num,
        "num": num,
        "type": "small_num",
        text: num
    }).appendTo("#cell_" + cell_num);

    var small_num_pos = [
        {top:5,  left:10}, {top:5,  left:24}, {top:5,  left:38},
        {top:19, left:10}, {top:19, left:24}, {top:19, left:38},
        {top:33, left:10}, {top:33, left:24}, {top:33, left:38}
    ];

    small_num.offset({
        top:  td.offset().top  + small_num_pos[num-1].top,
        left: td.offset().left + small_num_pos[num-1].left
    });
}
function insertBigNum(td, num)
{
    var cell_num = getCellNum(td);
    $("<div/>", {
        "class": "big_num",
        "id": 'big_num_' + cell_num + '_' + num,
        "num": num,
        "type": "big_num",
        text: num
    }).appendTo(td);
}

function erasePencil(td)
{
    td.children("div[type=small_num]").remove();
}
function eraseBigNum(td)
{
    td.children("div[type=big_num]").remove();
}
function eraseSmallNum(td, num)
{
    td.children("div[type=small_num][num="+num+"]").remove();
}

function lockCell(td)
{
    td.toggleClass('unlock lock');
}
function unLockCell(td)
{
    td.toggleClass('lock unlock');
}

function checkerOnOff(element)
{
    if (element.hasClass('on'))
        element.toggleClass('off on');
    else if (element.hasClass('off'))
        element.toggleClass('on off');
}

function exist(element)
{
    return (element.length > 0);
}

function getSelectNum(select_num_elem)
{
    return select_num_elem.attr('id').substring(4, 5);
}
function getCellNum(cell_element)
{
    return cell_element.attr('id').substring(5);
}