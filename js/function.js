var path = window.location.pathname.substr(1, window.location.pathname.indexOf('.') - 1)

function standardizedString(string) {
    while (string.includes('-')) {
       string.replace('-',' ')
    }
    return string.charAt(0).toUpperCase() + string.substr(1)
}
function getTitle() {
    document.write(standardizedString(path))
}
function navigatorSelected() {
    const navigators = document.getElementsByClassName("nav-item")
    if (path === 'index') {
        navigators[0].className += 'active'
    }
    else
        for (let i = 1; i < navigators.length; i++) {
            console.log(navigators[i].innerText)
            if ((navigators[i].innerText) === path) {
                navigators[i].className += 'active'
            }
            else navigators[i].className = 'nav-item'

        }
}
