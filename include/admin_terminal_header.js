/* admin_terminal_header.js */
/*  */

/*  */
function menu_active(ulId) {
    var ulElements = document.getElementById(ulId);
    if (ulElements.style.display === "none" || ulElements.style.display === "") {
        ulElements.style.display = "block";
    } else {
        ulElements.style.display = "none";
    }
}

function handleOkClick() {
    var submenu = document.getElementById('submenu');
    // 切换二级菜单的显示/隐藏
    if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
}
