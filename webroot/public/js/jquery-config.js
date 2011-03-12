var autoSearchTimer;
const AUTO_SEARCH_DELAY = 150;
const AUTO_SEARCH_HIDE = 100;
var distanceToFeedback;

var ajaxForms = [
	'.ajaxSubmittable'
];

/**
 * Identical to jQuery.find(), but will include the target element in the result
 * set if it matches the selector.
 */
jQuery.fn.findOrMatch = function(selector) {
	var results = this.find(selector);
	if(this.is(selector)) {
		results = results.add(this);
	}
	return results;
};

$(document).ready(function(){
	initBehaviors(document);
	initFeedback();
	initFeedbackScroll();
	initLightbox();
});

function initFeedback() {
	$('.feedback').click(function() {
		$(this).fadeOut();
	}).css('cursor', 'pointer').attr('title', 'click to hide');
}

function initFeedbackScroll() {
	distanceToFeedback = $('#feedback').offset().top;
	$(window).scroll(function() { 
		var el = $('#feedback'); 
		if($(this).scrollTop() > distanceToFeedback) {
			if(el.css('position') != 'fixed') {
				el.css({'position': 'fixed', 'top': '0px'}); 
			}
		} else if(el.css('position') == 'fixed') {
			el.css('position', 'static');
		}
	});
}

/**
 * Refreshes the feedback list. Should be called after ajax requests to avoid
 * building up a backlog of feedback messages.
 */
function refreshFeedback() {
	$.get(ROOT+'feedback', function(data) {
		$('#feedback').html(data);
		initFeedback();
	});
}

/**
 * Simply sets the page's main content DIV to the given content and initializes
 * behaviors on it.
 */
function setContent(content, contentArea) {
	if(contentArea == undefined) {
		contentArea = $('#content');
	}
	contentArea.html(content);
	initBehaviors(contentArea);
}

/**
 * Refreshes the content DIV.
 */
function refreshContent() {
	$.get(ROOT+ROUTE, function(data){setContent(data)});
}

function initLightbox() {
	var lb = $('#lightbox-content');
	var bd = $('#lightbox-backdrop');
	bd.click(function() {
		lb.hide();
		bd.hide();
	}).click();
}

function lightboxShow(content) {
	var lb = $('#lightbox-content');
	if(content != undefined) {
		lb.html(content);
	}
	lb.show();
	initBehaviors(lb);
	$('#lightbox-backdrop').show();
}

/**
 * Initializes class-based behaviors on all child elements of the given
 * element.
 */
function initBehaviors(el) {
	$(el).find('a.lightbox').click(function() {
		$.get($(this).attr('href'), lightboxShow);
		return false;
	});
	
	/**
	 * Select-all checkboxes
	 */
	$(el).find('.selectAll').change(function() {
		var master = this;
		$(this).closest('table').find('td:first-child input[type=checkbox]').each(function() {
			$(this).attr('checked', master.checked);
		});
	});
	
	$(el).find(ajaxForms.join(',')).each(function() {
		makeFormAjax(this);
	});
	
	$(el).find('.help').mouseover(function(){
		var div = document.createElement('DIV');
		$(div).addClass('helpText');
		
		var title = this.title;
		$(div).html(title);
		this.title = '';
		
		$(this).append(div);
		$(this).mouseout(function() {
			$(div).remove();
			this.title = title;
		});
	});
}

/**
 * Makes a form submittable via ajax. If no callback method is supplied, the
 * content div will be replaced with the response and Feedback will be refreshed.
 */
function makeFormAjax(form, callback) {
	if(callback == undefined) {
		callback = function(data) {
			refreshFeedback();
			setContent(data, $(form).closest('.contentArea'));
		}
	}
	
	$(form).submit(function(e) {
		e.preventDefault();

		var url = $(this).attr('action');
		var formData = $(this).serializeArray();
		var method = $(this).attr('method') ? $(this).attr('method') : 'GET';
		
		$.ajax({
			'url' : url,
			'type' : method,
			'data' : formData,
			'success' : callback,
			'error' : refreshFeedback
		});
	});
}