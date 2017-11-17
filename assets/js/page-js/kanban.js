//Script for scrollbar 
(function() {
    "use strict";

    // custom scrollbar

    $(".jqx-kanban-column-container").niceScroll({styler:"fb",cursorcolor:"#68ae00", cursorwidth: '6', cursorborderradius: '10px', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".scrollbar1").niceScroll({styler:"fb",cursorcolor:"#68ae00", cursorwidth: '6', cursorborderradius: '0',autohidemode: 'false', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0'});

	
	
    $(".scrollbar1").getNiceScroll();
    if ($('body').hasClass('scrollbar1-collapsed')) {
        $(".scrollbar1").getNiceScroll().hide();
    }

})(jQuery);

             


$(document).ready(function () {
            var fields = [
                     { name: "id", type: "string" },
                     { name: "status", map: "state", type: "string" },
                     { name: "text", map: "label", type: "string" },
                     { name: "tags", type: "string" },
                     { name: "color", map: "hex", type: "string" },
                     { name: "resourceId", type: "number" }
            ];
            var source =
             {
                 localData: [
                          { id: "1161", state: "new", label: "Combine Orders", tags: "orders, combine", hex: "#5dc3f0"},
                          { id: "1645", state: "work", label: "Change Billing Address", tags: "billing", hex: "#f19b60" },
                          { id: "9213", state: "new", label: "One item added to the cart", tags: "cart", hex: "#5dc3f0" },
                          { id: "6546", state: "done", label: "Edit Item Price", tags: "price, edit", hex: "#5dc3f0" },
                          { id: "9034", state: "new", label: "Login 404 issue", tags: "issue, login", hex: "#6bbd49" }
                 ],
                 dataType: "array",
                 dataFields: fields
             };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var resourcesAdapterFunc = function () {
                var resourcesSource =
                {
                    localData: [
                          { id: 0, name: "No name", image: "../../jqwidgets/styles/images/common.png", common: true },
                          { id: 1, name: "Andrew Fuller", image: "../../images/andrew.png" },
                          { id: 2, name: "Janet Leverling", image: "../../images/janet.png" },
                          { id: 3, name: "Steven Buchanan", image: "../../images/steven.png" },
                          { id: 4, name: "Nancy Davolio", image: "../../images/nancy.png" },
                          { id: 5, name: "Michael Buchanan", image: "../../images/Michael.png" },
                          { id: 6, name: "Margaret Buchanan", image: "../../images/margaret.png" },
                          { id: 7, name: "Robert Buchanan", image: "../../images/robert.png" },
                          { id: 8, name: "Laura Buchanan", image: "../../images/Laura.png" },
                          { id: 9, name: "Laura Buchanan", image: "../../images/Anne.png" }
                    ],
                    dataType: "array",
                    dataFields: [
                         { name: "id", type: "number" },
                         { name: "name", type: "string" },
                         { name: "image", type: "string" },
                         { name: "common", type: "boolean" }
                    ]
                };
                var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
                return resourcesDataAdapter;
            }
            $('#kanban').jqxKanban({
                resources: resourcesAdapterFunc(),
                source: dataAdapter,
                columns: [
                    { text: "Backlog", dataField: "new" },
                    { text: "In Progress", dataField: "work" },
                    { text: "Done", dataField: "done" }
                ]
            }); 
        });