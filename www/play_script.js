$(document).ready(function(){

    var construct_mode = $('#construct_mode'),
        pencil = $('#pencil'),
        eraser = $('#erase');

    construct_mode.click(function(){checkerOnOff($(this));});
    pencil.        click(function(){checkerOnOff($(this));});
    eraser.        click(function(){checkerOnOff($(this));});

    $('.num').click(function(){
        var self = $(this);
        checkerOnOff(self);

        var on_num = self.siblings('.num.on');
        on_num.toggleClass('off on');
    });

    $('.net td').click(function(){
        var td = $(this),
            num_elem = $('.num.on'),
            num = num_elem.attr('id').substring(4, 5),
            cell_num = td.attr('id').substring(5),

            isConstruct = construct_mode.hasClass('on'),
            isPencil = pencil.hasClass('on'),
            isErase = eraser.hasClass('on'),

            isLockCell = td.hasClass('lock');

        var eraseInConstruct = (isConstruct && num_elem && isErase),
            drawInConstruct =  (isConstruct && num_elem && !isErase),

            drawByPencil = (!isConstruct && num_elem && !isLockCell && !isErase && isPencil),
            draw =         (!isConstruct && num_elem && !isLockCell && !isErase && !isPencil),

            erasePencil = (!isConstruct && num_elem && !isLockCell && isErase && isPencil),
            erase =       (!isConstruct && num_elem && !isLockCell && isErase && !isPencil);


        if (eraseInConstruct)
        {
            doEraseNum(td);
            unLockCell(td);
        }
        if (drawInConstruct)
        {
            var insText = insertNum(td, num);

            if (insText)
                lockCell(td);
            else
                unLockCell(td);
        }

        if (drawByPencil)
        {
            var small_num = $('#small_num_' + cell_num + '_' + num);
            var addSmallNum = (!small_num.length && !td.text()),
                removeSmallNum = (small_num.length);

            if (addSmallNum)
            {
                small_num = $("<div/>", {
                    "class": "small_num",
                    "id": 'small_num_' + cell_num + '_' + num,
                    text: num
                }).appendTo("#net_wrapper");

                var small_num_pos = [ {top:3,  left:10}, {top:3,  left:24}, {top:3,  left:38},
                    {top:18, left:10}, {top:18, left:24}, {top:18, left:38},
                    {top:33, left:10}, {top:33, left:24}, {top:33, left:38}
                ];

                small_num.offset({
                    top:  td.offset().top  + small_num_pos[num-1].top,
                    left: td.offset().left + small_num_pos[num-1].left
                });
            }

            if (removeSmallNum)
            {
                small_num.remove();
            }
        }

        if (erasePencil)
        {
            doErasePencil(td);
        }

        if (draw)
        {
            insertNum(td, num);
            doErasePencil(td);
        }

        if (erase)
        {
            doEraseNum(td);
        }
    });
});

function lockCell(td)
{
    td.addClass('lock');
}
function unLockCell(td)
{
    td.removeClass('lock');
}

function insertNum(td, num)
{
    var text = td.text(),
        insText = (text==num) ? "" : num;
    td.text(insText);
    return insText;
}
function doErasePencil(td)
{
    var cell_num = td.attr('id').substring(5);
    $("div[id^=small_num_" + cell_num + "_]").remove();
}
function doEraseNum(td)
{
    td.text("");
}

function checkerOnOff(element)
{
    if (element.hasClass('on'))
        element.toggleClass('off on');
    else if (element.hasClass('off'))
        element.toggleClass('on off');
}
