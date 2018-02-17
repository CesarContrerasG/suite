"use strict";

var app = document.getElementById("app");
var users = [{
    name: "Cristhofer",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}, {
    name: "Ana Rosario",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}, {
    name: "Cesar Contreras",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}, {
    name: "Madian Medel",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}, {
    name: "Veronica Barrón",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}, {
    name: "Grecia Contreras",
    img: "https://avatars0.githubusercontent.com/u/5553332"
}];

var Avatar = function Avatar(props) {
    return React.createElement("img", { src: props.user.img, alt: props.user.name });
};

var UserName = function UserName(props) {
    return React.createElement(
        "p",
        null,
        props.user.name
    );
};

var User = function User(props) {
    return React.createElement(
        "div",
        { className: "user-item" },
        React.createElement(Avatar, { user: props.user }),
        React.createElement(UserName, { user: props.user })
    );
};

var UsersList = function UsersList(props) {
    var userList = props.list.map(function (user, i) {
        return React.createElement(User, { user: user, key: i });
    });
    return React.createElement(
        "div",
        { className: "user-list" },
        userList
    );
};

ReactDOM.render(React.createElement(UsersList, { list: users }), app);