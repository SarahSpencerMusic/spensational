// This is just a sample script. Paste your real code (javascript or HTML) here.
! function(e) {
    parseInt(scripted_misc_links.WP_version) < 4 && (e(".preview-notice").prepend('<span style="font-weight:bold;">' + scripted_misc_links.old_version_message + "</span>"), jQuery("#customize-info .btn-upgrade, .misc_links").click(function(e) {
        e.stopPropagation()
    })), e(".preview-notice").prepend('<span id="scripted_upgrade"><a target="_blank" class="button btn-upgrade" href="' + scripted_misc_links.upgrade_link + '">' + scripted_misc_links.upgrade_text + "</a></span>"), jQuery("#customize-info .btn-upgrade, .misc_links").click(function(e) {
        e.stopPropagation()
    })
}(jQuery),
function(e) {
    e.controlConstructor.radio = e.Control.extend({
        ready: function() {
            "scripted_theme_options[color_scheme]" === this.id && this.setting.bind("change", function(o) {
                jQuery.each(scripted_misc_links.color_list, function(i, n) {
                    "light" == o ? (e(i).set(n.light), e.control(i).container.find(".color-picker-hex").data("data-default-color", n.light).wpColorPicker("defaultColor", n.light)) : "dark" == o && (e(i).set(n.dark), e.control(i).container.find(".color-picker-hex").data("data-default-color", n.dark).wpColorPicker("defaultColor", n.dark))
                }), jQuery('input[name="_customize-radio-scripted_theme_options[mobile_menu_color_scheme]"][value="' + o + '"]').prop("checked", !0)
            })
        }
    })
}(wp.customize);