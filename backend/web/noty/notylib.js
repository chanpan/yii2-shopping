function noty(type='success', layout='bottomRight', message=''){
    new Noty({
                    type: type,
                    layout: layout,
                    theme: 'mint',
                    text: message,
                    timeout: 5000,
                    progressBar: true,
                    closeWith: ['click', 'button'],
                    animation: {
                      open: 'noty_effects_open',
                      close: 'noty_effects_close'
                    },
                    id: false,
                    force: false,
                    killer: false,
                    queue: 'global',
                    container: false,
                    buttons: [],
                    sounds: {
                      sources: [],
                      volume: 1,
                      conditions: []
                    },
                    titleCount: {
                      conditions: []
                    },
                    modal: false
             }).show();
}
function notyconfirm(message){
	var n = new Noty({
	  text:message,
	  buttons: [
	    Noty.button('YES', 'btn btn-success', function () {
	        console.log('button 1 clicked');
	    }, {id: 'button1', 'data-status': 'ok'}),

	    Noty.button('NO', 'btn btn-error', function () {
	        console.log('button 2 clicked');
	        n.close();
	    })
	  ]
	}).show();
}