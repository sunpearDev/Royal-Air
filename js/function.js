class Function {
    getTitle() {
        let path = window.location.pathname
        document.write(path.charAt(1).toUpperCase() + path.substr(2))
    }
}
var func = new Function()