/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

function showMenu() {
    document.getElementById('side_menu').classList.toggle('show_side_menu');
    document.getElementById('black_div').classList.toggle('show_black_div');
}

function hideMenu() {
    document.getElementById('side_menu').classList.toggle('show_side_menu');
    document.getElementById('black_div').classList.toggle('show_black_div');

}

function clearForm(form_id) {
    $('#' + form_id + ' input:not([type="submit"])').val("");
    $('#' + form_id + ' textarea').val("");
    $('#' + form_id + ' select').val("");
    $('#' + form_id + ' input[type="radio"]').prop('checked', false);
    $('#' + form_id + ' input[type="checkbox"]').prop('checked', false);
}


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

