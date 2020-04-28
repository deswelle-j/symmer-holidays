$('#add-picture').click(function(){
    const index = +$('#widgets-counter').val();

    const tmpl = $('#advertisement_pictures').data('prototype').replace(/__name__/g, index);

    $('#advertisement_pictures').append(tmpl);

    $('#widgets-counter').val(index + 1);

    handleDelete()
});

function handleDelete() {
    $('button[data-action="delete"').click(function(){
        const target = this.dataset.target
        $(target).remove();
    })
}

function updateWidgetsConter() {
    const count = +$('#advertisement_pictures div.form-group').length;

    $('#widgets-counter').val(count);
}
updateWidgetsConter()
handleDelete()