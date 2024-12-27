var JSON = {
    menu: [
        { name: 'Dashboard', link: '../dashboard.php' , sub: null,role:"user" },
        { name: 'Websites', link: '../dashboard.php', sub: null,role:"user" },
        { name: 'Services', link: null, sub: null },
        { name: 'My Services', link: null,
            sub: [
                { name: 'Add To Service', link: '0-0', sub: null,role:"user" },
                { name: 'All Services', link: '0-1', sub: null,role:"user" },
            ]
        },
        { name: 'Services', link: null, sub: null,role:"user" },
        { name: 'Reports', link: '../dashboard.php' , sub: null,role:"user" },
        { name: 'Support', link: null, sub: null },
        { name: 'My Ticket', link: null,
            sub: [
                { name: 'New Ticket', link: '0-0', sub: null,role:"user" },
                { name: 'All Services', link: '0-1', sub: null, role:"user"},
            ]
        },
    ]
};


$(function() {

    function parseMenu(ul, menu) {
        for (var i = 0; i < menu.length; i++) {

            var li = $('<a class="menu-link" href="' + menu[i].link + '">'+'<span class="menu-icon">\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="ki-duotone ki-element-11 fs-2">\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class="path1"></span>\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class="path2"></span>\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t</i>\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t</span>'+' <span class="menu-title">'+menu[i].name+'</span>' +  + '</a></li>').appendTo(ul);

            // If sub menus contain something
            if (menu[i].sub != null) {
                var subul = $('<div class="menu-sub menu-sub-accordion">' +
                    '<div class="menu-item">\n' +
                    '\n' +
                    '                                <a class="menu-link" href="'+menu[i].link+'">\n' +
                    '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class="menu-bullet">\n' +
                    '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class="bullet bullet-dot"></span>\n' +
                    '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>\n' +
                    '                                    <span class="menu-title">'+menu[i].name+'</span>\n' +
                    '                                </a>\n' +
                    '\n' +
                    '                            </div></div>');
                $(li).append(subul);
                parseMenu($(subul), menu[i].sub);
            }else {
                $(li).removeClass('menu-sub menu-sub-accordion');
            }
        }
    }

    var menu = $('.menu_js');
    parseMenu(menu, JSON.menu);

});