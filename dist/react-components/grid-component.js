"use strict";

var encabezados = [{ column: "Createdo El" }, { column: "Nombre" }, { column: "RFC" }, { column: "Razón Social" }, { column: "Sector" }, { column: "Dirección" }, { column: "Codigo Postal" }];

var data = [{
    created_at: "2017-02-09",
    nombre: "E-Code",
    rfc: "ECO20160808JB2",
    denominación: "ECode SA de CV",
    sector: "Tecnología",
    direccion: "Queretaro",
    cp: "76190"
}, {
    created_at: "2017-02-09",
    nombre: "Etam",
    rfc: "ETA151208J82",
    denominación: "Etam SA de CV",
    sector: "Comercio Internacional",
    direccion: "Queretaro",
    cp: "76037"
}, {
    created_at: "2017-02-09",
    nombre: "Apple",
    rfc: "APPL241016OC",
    denominación: "Apple Inc.",
    sector: "Tecnología",
    direccion: "California",
    cp: "76190"
}, {
    created_at: "2017-02-09",
    nombre: "A2 Hosting",
    rfc: "ATWO241016",
    denominación: "A2 HOSTING SA de CV",
    sector: "Tecnología",
    direccion: "Seatle",
    cp: "76190"
}, {
    created_at: "2017-02-09",
    nombre: "Pied Piper",
    rfc: "PDPP25102016",
    denominación: "PIED PIPER Inc",
    sector: "Tecnología",
    direccion: "Silicon Valley",
    cp: "76190"
}, {
    created_at: "2017-02-09",
    nombre: "Grupo CVA",
    rfc: "CVA9904266T0",
    denominación: "Comercializadora SA de CV",
    sector: "Comercio",
    direccion: "Queretaro",
    cp: "76190"
}];

var content = document.getElementById("grid-component");
var datagrid = {
    headers: encabezados,
    rows: data
};

var ColumnGridHeader = function ColumnGridHeader(props) {
    return React.createElement(
        "th",
        null,
        props.header.column
    );
};

var GridHeader = function GridHeader(props) {
    var headers = props.list.map(function (header, i) {
        return React.createElement(ColumnGridHeader, { header: header, key: i });
    });
    return React.createElement(
        "thead",
        null,
        React.createElement(
            "tr",
            null,
            headers
        )
    );
};

var RowGridBody = function RowGridBody(props) {
    return React.createElement(
        "tr",
        null,
        React.createElement(
            "td",
            null,
            props.row.created_at
        ),
        React.createElement(
            "td",
            null,
            props.row.nombre
        ),
        React.createElement(
            "td",
            null,
            props.row.rfc
        ),
        React.createElement(
            "td",
            null,
            props.row.denominación
        ),
        React.createElement(
            "td",
            null,
            props.row.sector
        ),
        React.createElement(
            "td",
            null,
            props.row.direccion
        ),
        React.createElement(
            "td",
            null,
            props.row.cp
        )
    );
};

var GridBody = function GridBody(props) {
    var rows = props.list.map(function (row, i) {
        return React.createElement(RowGridBody, { row: row, key: i });
    });
    return React.createElement(
        "tbody",
        null,
        rows
    );
};

var GridComponent = function GridComponent(props) {
    return React.createElement(
        "div",
        { className: "grid-component" },
        React.createElement(
            "table",
            null,
            React.createElement(GridHeader, { list: props.datagrid.headers }),
            React.createElement(GridBody, { list: props.datagrid.rows })
        )
    );
};

ReactDOM.render(React.createElement(GridComponent, { datagrid: datagrid }), content);