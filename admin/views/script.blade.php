<script defer>
    function badgeProductGeneralSubmit(element) {

		let loading = element.find('.loading');

	    let data        = element.serializeJSON();

	    data.action     = 'ProductBadgeAjax::generalSave';

	    loading.show();

	    request.post(ajax, data).then(function(response) {

		    SkilldoHelper.message.response(response);

		    loading.hide();
	    });

	    return false;
    }

    var badgeStyle = [];

    class BadgeProductHandler {

	    constructor(element, id) {

		    this.element = element;

		    this.id = id;

		    this.element.attr('data-id', this.id);

		    this.styleId = this.element.find('.js_badge_style_item.active').attr('data-style')

		    this.objectId = this.element.attr('data-tab-key')

		    this.loading = this.element.find('.loading')

		    this.form = this.element.find('.js_badge_style_form')

            this.loadForm();
	    }

	    loadForm() {

		    if(this.styleId === undefined || this.objectId === undefined) return false;

		    this.loading.show();

		    let self =  this;

		    let data = {
			    action : 'ProductBadgeAjax::styleLoad',
			    style: this.styleId,
			    objectId: this.objectId
		    }

		    request.post(ajax, data).then(function(response) {

			    self.loading.hide();

			    if(response.status == 'success') {

				    let form = decodeURIComponent(atob(response.data).split('').map(function (c) {
					    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
				    }).join(''));

				    self.form.find('.box-content').html(form).promise().done(function () {
					    FormHelper.reset();
					    FormHelper.validateRegister();
				    });

			    }
			    else {
				    SkilldoHelper.message.response(response);
			    }
		    });

		    return false;
	    }

	    clickItem(element) {

		    if(element.attr('data-style') == this.styleId) return false;

		    this.element.find('.js_badge_style_item').removeClass('active');

		    element.addClass('active');

		    this.styleId = element.attr('data-style');

		    this.loadForm()

		    return false;
	    }

	    styleSave(element) {

		    let data        = element.serializeJSON();

		    data.action     = 'ProductBadgeAjax::objectSave';

		    data.styleId    = this.styleId;

		    data.objectId   = this.objectId;

		    request.post(ajax, data).then(function(response) {

			    SkilldoHelper.message.response(response);
		    });
	    }

	    static object(element, badgeStyle) {

		    let badge = element.closest('.js_badge_style_main');

		    let id = element.closest('.js_badge_style_main').attr('data-id');

		    if(typeof badgeStyle[id] === 'undefined') {
			    id = uniqid();
			    badgeStyle[id] = new BadgeProductHandler(badge, id)
		    }

		    return badgeStyle[id];
	    }
    }

    function badgeProductStyleSubmit(element) {
	    return BadgeProductHandler.object(element, badgeStyle).styleSave(element);
    }

	$(function() {

		$('.js_badge_style_main').each(function () {

			let id= SkilldoHelper.uniqId();

			badgeStyle[id] = new BadgeProductHandler($(this), id)
		});

		$(document).on('click', '.js_badge_style_item', function() {
			return BadgeProductHandler.object($(this), badgeStyle).clickItem($(this));
		});
	})
</script>
<style>
    <?php include FCPATH.Path::plugin().BADGE_NAME.'/assets/css/style.admin.css';?>
</style>