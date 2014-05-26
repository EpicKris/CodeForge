(function ($) {

	//
	// Table
	// --------------------------------------------------
	$.fn.table = function (sortFunctions) {
		return this.each(function (sortFunctions) {
			var $table = $(this);

			// Sort functions
			sortFunctions = sortFunctions || {};
			sortFunctions = $.extend({
				'int': function (a, b) {
					return parseInt(a, 10) - parseInt(b, 10);
				},
				'float': function (a, b) {
					return parseFloat(a) - parseFloat(b);
				},
				'string': function (a, b) {
					if (a < b) return -1;
					if (a > b) return +1;
					return 0;
				},
				'ip-address': function (a, b) {
					var aLength = a.length;
					var bLength = b.length;
					var length;
					var section = [];
					a = a.split('.');
					b = b.split('.');
					if (aLength == bLength) length = aLength;
					if (aLength < bLength) length = aLength;
					if (aLength > bLength) length = bLength;
					for (var i = 0; i < length; i++) {
						section[i] = parseInt(a[i], 10) - parseInt(b[i], 10);
						if (section[i] !== 0) return section[i];
					}
					return 0;
				}
			}, sortFunctions);

			// Column headers
			$table.on('click', 'th', function () {
				var $th = $(this);
				var columnHeaderIndex = 0;
				var direction = {
					ASC: 'asc',
					DESC: 'desc'
				};

				$table.find('th').slice(0, $th.index()).each(function () {
					var columns = $th.attr('colspan') || 1;
					columnHeaderIndex += parseInt(columns, 10);
				});

				// Determine sort direction
				var sortDirection = $th.data('sort-default') || direction.ASC;
				if ($th.data('sort-direction')) sortDirection = $th.data('sort-direction') === direction.ASC ? direction.DESC : direction.ASC;

				// Determine sort function
				var type = $th.data('sort-function') || null;

				// Disable sorting if no sort function defined
				if (type === null) return;

				// Trigger
				// Pre table sort
				$table.trigger('pretablesort', {
					column: columnHeaderIndex,
					direction: sortDirection
				});

				// Asynchronous
				setTimeout(function () {
					var column = [];
					var sortMethod = sortFunctions[type];
					var rows = $table.children('tbody').children('tr');

					// Get data
					rows.each(function (index, row) {
						var $cell = $(row).children().eq(columnHeaderIndex);
						var value = $cell.data('sort-value');
						value = typeof (value) !== 'undefined' ? value : $cell.text();
						column.push([value, row]);
					});

					// Sort
					column.sort(function (a, b) {
						return sortMethod(a[0], b[0]);
					});
					if (sortDirection != direction.ASC) column.reverse();

					// Update data
					rows = $.map(column, function (kv) {
						return kv[1];
					});
					$table.children('tbody').append(rows);

					// Reset other column headers
					$table.find('th').data('sort-direction', null).removeClass('sort-asc sort-desc');
					$th.data('sort-direction', sortDirection).addClass('sort-' + sortDirection);

					// Trigger
					// Post table sort
					$table.trigger('posttablesort', {
						column: columnHeaderIndex,
						direction: sortDirection
					});

					$table.css('display');
				}, 10);
			});
		});
	};

}(jQuery));