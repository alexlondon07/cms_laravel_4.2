/** Modulo que contiene las funciones y variables necesarias para el modulo tinta mezcla
 * @author Alexander Londoño
 * @since 2015-07-24
 */
var Shopping = {};

/**
 * Funcion que define variables y funciones
 */
(function() {
    /** variable para almacenar el nombre del contenedor de la tabla de formulas */
    Shopping.countTableElement = 0;
    Shopping.shoppingId = '';


    /**
     * Metodo para cargar la tabla de productos
     */
    Shopping.loadDataTable = function() {
        var d = {};
        d.shopping_id = Shopping.shoppingId;
        Util.callAjax(d, rootUrl + 'ajax/get_product_data_table', 'POST', Shopping.loadDataTableSuccess);
        //Cargamos datepicker a los que tenga dicha clase , para que despliege el calendario
        $('.datepicker').datepicker();
    };

    /**
     * Metodo Handler la ejecucion exitosa de metodo ajax en Shopping.loadShopingTable
     */
    Shopping.loadDataTableSuccess = function(data) {
        if (data.valid) {
            Shopping.dataShopping = data.Shopping;
            Shopping.dataProduct = data.product;

            Shopping.createTable(Shopping.divProduct, ['Item', 'Cantidad', 'Producto', 'Costo'], Shopping.addRowProduct);

            if (Shopping.shoppingId != '') {
                Shopping.loadPreviousTable();
            } else {
                Shopping.addRowProduct();
            }
        }
    };

    /**
     * Metodo para cargar en las tablas los valores previamente guardados
     */
    Shopping.loadPreviousTable = function() {
        for (var i in Shopping.dataShopping.products) {
            Shopping.addRowProduct(Shopping.dataShopping.products[i].pivot);
        }
    };

    Shopping.removeRowShoppingTable = function(d) {
        console.log(d);
    };
    /**
     * Metodo que agrega una fila a la tabla de Productos
     */
    Shopping.addRowProduct = function(setData) {
        var c = Shopping.countTableElement++;
        var input = null;
        var divId = Shopping.divProduct;
        var body = $('#' + divId + '_table_body');
        var deletable = $('#deletable').val();
        var editable = $('#editable').val();
        var td = document.createElement('td');
        var countColumn = 4;
        var countData = Shopping.dataProduct.length;
        var row = document.createElement('tr');
        //ahora se insertan las casillas para ingresar valores
        for (var j = 0; j < countColumn; j++) {
            //columna de acciones
            td = document.createElement('td');
            td.setAttribute('class', 'table_input_td');
            if (j == 0) {
                input = document.createElement('a');
                if (deletable == 'true') {
                    input.addEventListener('click', function(event) {
                        var arrInput = event.target.parentElement.parentElement.getElementsByTagName('input');
                        var deleteId = null;
                        for (var i in arrInput) {
                            if (arrInput[i].type.toLowerCase() == 'hidden') {
                                deleteId = arrInput[i].value;
                                break;
                            }
                        }
                        event.target.parentElement.parentElement.remove();
                        Shopping.removeRowShoppingTable(deleteId);
                    });
                    input.setAttribute('class', 'glyphicon glyphicon-trash btn btn-default btn-xs');
                    input.style.marginRight = '10px';
                }
                //se agrega ID del elemento
                var input2 = document.createElement('input');
                input2.id = 'tr_' + divId + '_id_' + c;
                input2.type = 'hidden';
                input2.value = c;
                td.appendChild(input2);
            }
            //columna de Cantidad
            else if (j == 1) {
                input = document.createElement('input');
                input.type = 'number';
                input.id = 'tr_' + divId + '_quantity_' + c;
                input.value = '';
                input.setAttribute('class', 'table_input');
                if (setData != undefined && setData.quantity != undefined) {
                    input.value = setData.quantity;
                }
            }
            //columna de Seleccion de product
            else if (j == 2) {
                input = document.createElement('select');
                input.id = 'tr_' + divId + '_product_id_' + c;
                input.setAttribute('class', 'select_style_none table_input');
                var option = document.createElement('option');
                option.value = 0;
                option.text = 'Seleccione...';
                input.appendChild(option);
                for (var k = 0; k < countData; k++) {
                    option = document.createElement('option');
                    option.value = Shopping.dataProduct[k].id;
                    option.text = Shopping.dataProduct[k].name;
                    input.appendChild(option);
                }
                if (setData != undefined && setData.product_id != undefined) {
                    input.value = setData.product_id;
                }
                //input.addEventListener('change', Shopping.quantityToPercent);
            }
            //columna de precio
            else if (j == 3) {
                input = document.createElement('input');
                input.type = 'text';
                input.id = 'tr_' + divId + '_cost_' + c;
                input.value = '';
                input.setAttribute('class', 'table_input');
                if (setData != undefined && setData.cost != undefined) {
                    input.value = setData.cost;
                }
            }
            if (editable == 'false') {
                input.setAttribute('readonly', 'true');
                input.disabled = true;
            }
            td.appendChild(input);
            row.appendChild(td);
        }
        //se agrega fila a la tabla
        body.append(row);
    };

    /**
     * Metodo para la creacion dinamica de la tabla
     * @param {String} container
     */
    Shopping.createTable = function(containerId, arrayColumnsHeader, callbackOnClickAddRow) {
        var container = $('#' + containerId);
        // se construye la tabla con lista de fuentes de financiacion y el plan de desarrollo
        var table = document.createElement('table');
        table.setAttribute('id', containerId + '_table');
        table.setAttribute('class', 'table table-bordered');
        var header = table.createTHead();
        var body = table.createTBody();
        body.setAttribute('id', containerId + '_table_body');
        var rowHeader = header.insertRow(0);
        var th = null;
        // se genera el encabezado de la tabla
        for (var j = 0; j < arrayColumnsHeader.length; j++) {
            th = document.createElement('th');
            th.appendChild(document.createTextNode(arrayColumnsHeader[j]));
            rowHeader.appendChild(th);
        }
        var add_button = document.createElement('a');
        add_button.text = ' Agregar';
        add_button.addEventListener('click', callbackOnClickAddRow);
        add_button.setAttribute('class', 'glyphicon glyphicon-plus-sign btn btn-primary');
        //se agrega la tabla al contenedor
        container.empty();
        container.append(add_button);
        container.append(table);
    };

    /**
     * Metodo que convierte los valores de la tabla en un objeto
     */
    Shopping.tableToObject = function(divId, inputId) {
        var tableObject = {};
        var arr = [];
        for (var j = 0; j < Shopping.countTableElement; j++) {
            var elem = {};
            if (Util.getValue('tr_' + divId + '_id_' + j) != null) {
                elem.id = Util.getValue('tr_' + divId + '_id_' + j);
                elem.quantity = Util.getValue('tr_' + divId + '_quantity_' + j);
                elem.product_id = Util.getValue('tr_' + divId + '_product_id_' + j);
                elem.cost = Util.getValue('tr_' + divId + '_cost_' + j);
                arr.push(elem);
            }
        }
        tableObject.elements = arr;
        document.getElementById(inputId).value = JSON.stringify(tableObject);
    };

    /**
     * Metodo que inicializa el modulo
     */
    Shopping.initialize = function() {
        Shopping.shoppingId = $('#shopping_id').val();
        Shopping.divProduct = 'div_products';
        Shopping.loadDataTable();//Llamamos la funcion para cargar los datos la primera fila

        $('#form_shopping').submit(function(event) {
            //event.preventDefault();
            Shopping.tableToObject(Shopping.divProduct, 'table_products');
            return true;
        });
    };

})();
/** funcion que se ejecuta al terminar el cargar el documento */
$(function() {
    Shopping.initialize();
});