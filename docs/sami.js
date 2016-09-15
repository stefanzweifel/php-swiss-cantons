
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">Wnx</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Wnx_SwissCantons" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Wnx/SwissCantons.html">SwissCantons</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Wnx_SwissCantons_Canton" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Wnx/SwissCantons/Canton.html">Canton</a>                    </div>                </li>                            <li data-name="class:Wnx_SwissCantons_CantonManager" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Wnx/SwissCantons/CantonManager.html">CantonManager</a>                    </div>                </li>                            <li data-name="class:Wnx_SwissCantons_CantonSearch" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Wnx/SwissCantons/CantonSearch.html">CantonSearch</a>                    </div>                </li>                            <li data-name="class:Wnx_SwissCantons_ZipcodeSearch" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Wnx/SwissCantons/ZipcodeSearch.html">ZipcodeSearch</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Wnx.html", "name": "Wnx", "doc": "Namespace Wnx"},{"type": "Namespace", "link": "Wnx/SwissCantons.html", "name": "Wnx\\SwissCantons", "doc": "Namespace Wnx\\SwissCantons"},
            
            {"type": "Class", "fromName": "Wnx\\SwissCantons", "fromLink": "Wnx/SwissCantons.html", "link": "Wnx/SwissCantons/Canton.html", "name": "Wnx\\SwissCantons\\Canton", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method___construct", "name": "Wnx\\SwissCantons\\Canton::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_setAbbreviation", "name": "Wnx\\SwissCantons\\Canton::setAbbreviation", "doc": "&quot;Set the abbreviation for given Canton.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_getAbbreviation", "name": "Wnx\\SwissCantons\\Canton::getAbbreviation", "doc": "&quot;Return Abbreviation for Canton.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_setNames", "name": "Wnx\\SwissCantons\\Canton::setNames", "doc": "&quot;Add Name Array to Property.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_getName", "name": "Wnx\\SwissCantons\\Canton::getName", "doc": "&quot;Return Display Name for given Language.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_getNamesArray", "name": "Wnx\\SwissCantons\\Canton::getNamesArray", "doc": "&quot;It Returns the Raw Name Array.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_setLanguage", "name": "Wnx\\SwissCantons\\Canton::setLanguage", "doc": "&quot;Set Language used to Display Canton Name.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\Canton", "fromLink": "Wnx/SwissCantons/Canton.html", "link": "Wnx/SwissCantons/Canton.html#method_getLanguage", "name": "Wnx\\SwissCantons\\Canton::getLanguage", "doc": "&quot;Return Language used to Display Canton Name.&quot;"},
            
            {"type": "Class", "fromName": "Wnx\\SwissCantons", "fromLink": "Wnx/SwissCantons.html", "link": "Wnx/SwissCantons/CantonManager.html", "name": "Wnx\\SwissCantons\\CantonManager", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonManager", "fromLink": "Wnx/SwissCantons/CantonManager.html", "link": "Wnx/SwissCantons/CantonManager.html#method___construct", "name": "Wnx\\SwissCantons\\CantonManager::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonManager", "fromLink": "Wnx/SwissCantons/CantonManager.html", "link": "Wnx/SwissCantons/CantonManager.html#method_getByAppreviation", "name": "Wnx\\SwissCantons\\CantonManager::getByAppreviation", "doc": "&quot;Get Canton by abbreviation.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonManager", "fromLink": "Wnx/SwissCantons/CantonManager.html", "link": "Wnx/SwissCantons/CantonManager.html#method_getByName", "name": "Wnx\\SwissCantons\\CantonManager::getByName", "doc": "&quot;Get Canton by Name.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonManager", "fromLink": "Wnx/SwissCantons/CantonManager.html", "link": "Wnx/SwissCantons/CantonManager.html#method_getByZipcode", "name": "Wnx\\SwissCantons\\CantonManager::getByZipcode", "doc": "&quot;Get Canton by Zipcode&quot;"},
            
            {"type": "Class", "fromName": "Wnx\\SwissCantons", "fromLink": "Wnx/SwissCantons.html", "link": "Wnx/SwissCantons/CantonSearch.html", "name": "Wnx\\SwissCantons\\CantonSearch", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonSearch", "fromLink": "Wnx/SwissCantons/CantonSearch.html", "link": "Wnx/SwissCantons/CantonSearch.html#method___construct", "name": "Wnx\\SwissCantons\\CantonSearch::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonSearch", "fromLink": "Wnx/SwissCantons/CantonSearch.html", "link": "Wnx/SwissCantons/CantonSearch.html#method_findByAppreviation", "name": "Wnx\\SwissCantons\\CantonSearch::findByAppreviation", "doc": "&quot;Find Canton by Abbreviation.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonSearch", "fromLink": "Wnx/SwissCantons/CantonSearch.html", "link": "Wnx/SwissCantons/CantonSearch.html#method_findByName", "name": "Wnx\\SwissCantons\\CantonSearch::findByName", "doc": "&quot;Find Canton by Name.&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\CantonSearch", "fromLink": "Wnx/SwissCantons/CantonSearch.html", "link": "Wnx/SwissCantons/CantonSearch.html#method_getDataSet", "name": "Wnx\\SwissCantons\\CantonSearch::getDataSet", "doc": "&quot;Read JSON Data.&quot;"},
            
            {"type": "Class", "fromName": "Wnx\\SwissCantons", "fromLink": "Wnx/SwissCantons.html", "link": "Wnx/SwissCantons/ZipcodeSearch.html", "name": "Wnx\\SwissCantons\\ZipcodeSearch", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "Wnx\\SwissCantons\\ZipcodeSearch", "fromLink": "Wnx/SwissCantons/ZipcodeSearch.html", "link": "Wnx/SwissCantons/ZipcodeSearch.html#method___construct", "name": "Wnx\\SwissCantons\\ZipcodeSearch::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\ZipcodeSearch", "fromLink": "Wnx/SwissCantons/ZipcodeSearch.html", "link": "Wnx/SwissCantons/ZipcodeSearch.html#method_findbyZipcode", "name": "Wnx\\SwissCantons\\ZipcodeSearch::findbyZipcode", "doc": "&quot;Find Data Set for a City by Zipcode&quot;"},
                    {"type": "Method", "fromName": "Wnx\\SwissCantons\\ZipcodeSearch", "fromLink": "Wnx/SwissCantons/ZipcodeSearch.html", "link": "Wnx/SwissCantons/ZipcodeSearch.html#method_getDataSet", "name": "Wnx\\SwissCantons\\ZipcodeSearch::getDataSet", "doc": "&quot;Read Zipcode JSON Data&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


