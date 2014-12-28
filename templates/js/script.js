$(document).ready(function(){

    var construct_btn = $('#construct_mode'),
        pencil_btn = $('#pencil'),
        eraser_btn = $('#erase'),
        load_btn = $('#load'),
        save_btn = $('#save'),
        cells = $('#net').find('td');

    construct_btn.click(function(){checkerOnOff($(this));});
    pencil_btn.   click(function(){checkerOnOff($(this));});
    eraser_btn.   click(function(){checkerOnOff($(this));});


    if ($.cookie('has_saved_game'))
    {
        load_btn.click();
    }

    $(window).unload(function(){
        save_btn.click();
    });

    save_btn.click(function(){
        var cell_classes = {},
            small_nums = {},
            big_nums = {};

        cells.each(function (i, cell) {
            var cell_id = cell.id,
                td = $('#'+cell_id);

            cell_classes[cell_id] = [];
            cell_classes[cell_id].push(td.attr("class"));

            small_nums[cell_id] = [];
            big_nums[cell_id] = [];
            td.children().each(function (j, num) {
                var num_element = $('#'+num.id);
                var type = num_element.data("type");

                if (type == 'small_num')
                {
                    small_nums[cell_id].push(num_element.data("num"));
                }
                if (type == 'big_num')
                {
                    big_nums[cell_id].push(num_element.data("num"));
                }
            });
        });

        $.cookie('cell_classes', $.toJSON(cell_classes), {expires:365});
        $.cookie('small_nums',   $.toJSON(small_nums),   {expires:365});
        $.cookie('big_nums',     $.toJSON(big_nums),     {expires:365});

        $.cookie('num', $(".num.on").attr("id"), {expires:365});
        $.cookie('level', $("#level").find(".select").attr("id"), {expires:365});
        $.cookie('has_saved_game', true, {expires:365});
	});

    load_btn.click(function(){
        var select_num_elem = $('.num.on'),
            select_num = exist(select_num_elem) ? getSelectNum(select_num_elem) : false;
        unMarkCell(select_num);

        insertSavedClasses($.cookie('cell_classes'));
        insertSavedNums($.cookie('small_nums'), insertSmallNum);
        insertSavedNums($.cookie('big_nums'), insertBigNum);

        $('#'+$.cookie('num')).click();
        $('#level').find('.select').removeClass('select');
        $('#'+$.cookie('level')).addClass('select');
	});
    function insertSavedClasses(json)
    {
        var cell_classes = $.parseJSON(json);

        cells.children().remove();
        cells.removeAttr("class");

        cells.each(function (i, cell) {
            var cell_id = cell.id,
                td = $('#'+cell_id);

            td.attr("class", cell_classes[cell_id]);
        });
    }
    function insertSavedNums(json, method)
    {
        var nums = $.parseJSON(json);
        for (var cell_id in nums) {
            if (nums.hasOwnProperty(cell_id))
            {
                nums[cell_id].forEach(function (item, j, cell_nums) {
                    cell_nums.forEach(function (num) {
                        method($('#' + cell_id), num);
                    });
                });
            }
        }
    }

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
		
		var cell_class = (construct_btn.hasClass('off') || !exist(construct_btn)) ? ".unlock" : "";
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

    cells.click(function(){
        var td = $(this),
            select_num_elem = $('.num.on'),
            select_num = exist(select_num_elem) ? getSelectNum(select_num_elem) : false,

            isConstruct = construct_btn.hasClass('on'),
            isPencil = pencil_btn.hasClass('on'),
            isErase = eraser_btn.hasClass('on'),

            isLockCell = td.hasClass('lock'),

            noBigNum = (!exist(td.children(".big_num"))),
            hasSelectBigNum = exist(td.children("div[data-type=big_num][data-num="+select_num+"]")),
            hasSelectSmallNum = exist(td.children("div[data-type=small_num][data-num="+select_num+"]"));

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
    net.find("div[data-num="+num+"][data-type=big_num]").parent().addClass('mark_big_num');
    net.find("div[data-num="+num+"][data-type=small_num]").parent().addClass('mark_small_num');
}
function unMarkCell(num)
{
    var net = $("#net");
    net.find("div[data-num="+num+"][data-type=big_num]").parent().removeClass('mark_big_num');
    net.find("div[data-num="+num+"][data-type=small_num]").parent().removeClass('mark_small_num');
}

function insertSmallNum(td, num)
{
    var cell_num = getCellNum(td);
    var small_num = $("<div/>", {
        "class": "small_num",
        "id": 'small_num_' + cell_num + '_' + num,
        "data-num": num,
        "data-type": "small_num",
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
        "data-num": num,
        "data-type": "big_num",
        text: num
    }).appendTo(td);
}

function erasePencil(td)
{
    td.children("div[data-type=small_num]").remove();
}
function eraseBigNum(td)
{
    td.children("div[data-type=big_num]").remove();
}
function eraseSmallNum(td, num)
{
    td.children("div[data-type=small_num][data-num="+num+"]").remove();
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