function fillInstructions() {
	var commentTop = $($('.comment')[0]);
	var text = "Comments other users have made about this document are shown in yellow boxes like this one the left and right sides of the page."
	commentTop.html('<div class="comment-holder left"><div class="user-comment">'+text+'</div></div><div class="comment-holder right"></div>');
}

fillInstructions();

function fillComments(commentData) {
	var comments = $('.comment');
	console.log(commentData);
	for (var i = 1; i < comments.length; i++) {
		var answer = 'answer' + i;
		var comment = $(comments[i]);
		var commentNum = commentData.length;
                if (commentNum > 5) commentNum = 5;
		var commentHolder = $('<div class="comment-holder left"></div><div class="comment-holder right"></div>');

		var commentsArray = [];
		for (var j = 0; j < commentNum; j++) {
                        if (commentData[j]) {
			var text = commentData[j][answer];
			if (text.length > 0) {
				if (text.length > 1000) {
					text = text.substring(0, 1000) + "...";
				}
				commentsArray.push(text);
			}
                        }
		}
		for (var j = 0; j < commentsArray.length; j++) {
			var text = commentsArray[j];
			if (j < 3) {
				var userComment = $('<div class="user-comment">'+text+'</div>');
				var leftHolder = $(commentHolder[0]);
				leftHolder.append(userComment);
			} else {
				var userComment = $('<div class="user-comment">'+text+'</div>');
				var rightHolder = $(commentHolder[1]);
				rightHolder.append(userComment);
			}
		}
		comment.html('');
		comment.append(commentHolder);
	}
}

$.ajax({
	url: "api/get_comments.php",
	dataType: "json",
	type: "GET",
	data: { symbol: symbol },
	success: function(data) {
		fillComments(data);
	}
});
