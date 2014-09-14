(function() {
    tinymce.PluginManager.add('kopa_shortcode', function(editor) {
        var grid = new Array(12);
        grid[0] = '[col col=12]TEXT[/col]<br/>';
        grid[1] = '[col col=6]TEXT[/col]<br/>';
        grid[1] += '[col col=6]TEXT[/col]<br/>';
        grid[2] = '[col col=4]TEXT[/col]<br/>';
        grid[2] += '[col col=4]TEXT[/col]<br/>';
        grid[2] += '[col col=4]TEXT[/col]<br/>';
        grid[3] = '[col col=4]TEXT[/col]<br/>';
        grid[3] += '[col col=8]TEXT[/col]<br/>';
        grid[4] = '[col col=3]TEXT[/col]<br/>';
        grid[4] += '[col col=6]TEXT[/col]<br/>';
        grid[4] += '[col col=3]TEXT[/col]<br/>';
        grid[5] = '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[6] = '[col col=3]TEXT[/col]<br/>';
        grid[6] += '[col col=9]TEXT[/col]<br/>';
        grid[7] = '[col col=2]TEXT[/col]<br/>';
        grid[7] += '[col col=8]TEXT[/col]<br/>';
        grid[7] += '[col col=2]TEXT[/col]<br/>';
        grid[8] = '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=6]TEXT[/col]<br/>';
        grid[9] = '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[10] = '[col col=8]TEXT[/col]<br/>';
        grid[10] += '[col col=4]TEXT[/col]<br/>';
        grid[11] = '[col col=10]TEXT[/col]<br/>';
        grid[11] += '[col col=2]TEXT[/col]<br/>';

        var grid_icons = new Array(
                '11',
                '12_12',
                '13_13_13',
                '13_23',
                '14_12_14',
                '14_14_14_14',
                '14_34',
                '16_46_16',
                '16_16_16_12',
                '16_16_16_16_16_16',
                '23_13',
                '56_16');

        editor.addButton('kopa_shortcode', {
            type: 'splitbutton',
            title: 'shortcode',
            icon: 'kopa-shortcode',
            menu: [
                {
                    text: kopa_variable.i18n.grid,
                    icon: 'grid',
                    menu: [
                        {
                            text: '1/1',
                            icon: grid_icons[0],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[0] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/2 - 1/2',
                            icon: grid_icons[1],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[1] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/3 - 1/3 - 1/3',
                            icon: grid_icons[2],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[2] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/3 - 2/3',
                            icon: grid_icons[3],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[3] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 1/2 - 1/4',
                            icon: grid_icons[4],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[4] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 1/4 - 1/4 - 1/4',
                            icon: grid_icons[5],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[5] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 3/4',
                            icon: grid_icons[6],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[6] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 4/6 - 1/6',
                            icon: grid_icons[7],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[7] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 1/6 - 1/6 - 1/2',
                            icon: grid_icons[8],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[8] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6',
                            icon: grid_icons[9],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[9] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '2/3 - 1/3',
                            icon: grid_icons[10],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[10] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '5/6 - 1/6',
                            icon: grid_icons[11],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[11] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.container,
                    icon: 'container',
                    menu: [
                        {
                            text: 'Tabs',
                            icon: 'tabs',
                            onclick: function() {
                                kopaContainerType = 'tab';
                                KopaShortcode.load_shortcode_template('tmpl-kopa-container-builder', '&shortcode=container');
                            }
                        },
                        {
                            text: 'Accordion',
                            icon: 'accordion',
                            onclick: function() {
                                kopaContainerType = 'accordion';
                                KopaShortcode.load_shortcode_template('tmpl-kopa-container-builder', '&shortcode=container');
                            }
                        },
                        {
                            text: 'Toggle',
                            icon: 'accordion',
                            onclick: function() {
                                kopaContainerType = 'toggle';
                                KopaShortcode.load_shortcode_template('tmpl-kopa-container-builder', '&shortcode=container');
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.video,
                    icon: 'video',
                    menu: [
                        {
                            text: 'Youtube',
                            icon: 'youtube',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[youtube id="YOUR_ID"]');
                            }
                        },
                        {
                            text: 'Vimeo',
                            icon: 'vimeo',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[vimeo id="YOUR_ID"]');
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.dropcap,
                    icon: 'dropcap',
                    menu: [
                        {
                            text: 'Square',
                            icon: 'square',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap class="kp-dropcap style-1"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                            }
                        },
                        {
                            text: 'Circle',
                            icon: 'circle',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap class="kp-dropcap style-2"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                            }
                        },
                        {
                            text: 'Solid',
                            icon: 'solid',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap class="kp-dropcap style-3"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.blockquote,
                    icon: 'blockquote',
                    menu: [
                        {
                            text: 'Icon before',
                            icon: 'blockquote',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[blockquote class="kp-blockquote-2"]' + tinyMCE.activeEditor.selection.getContent() + '[/blockquote]');
                            }
                        },
                        {
                            text: 'Icon after',
                            icon: 'blockquote',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[blockquote class="kp-blockquote"]' + tinyMCE.activeEditor.selection.getContent() + '[/blockquote]');
                            }
                        }
                    ]
                },
                {
                    text: 'button',
                    icon: 'button',
                    onclick: function() {
                        KopaShortcode.load_shortcode_template('tmpl-kopa-button-builder', '&shortcode=button');
                    }
                }
            ]
        });
    });
})();