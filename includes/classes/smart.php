<?php

	class Smart {
		 

		function find_article_author( $articleID="" ){
			$article = New Article();

			$author = 'none';

			// get article
			$article = $article->single_article( $articleID );

			if( $article->adminID != 0 ){
				$user = new User();

				$author = $user->single_user_names( $article->adminID );

			} else {

				$student = New Student();

				$author = $student->single_student_names( $article->stdID );
			}

			return $author;
		}

		function find_comment_author( $commentID="" ){
			$comment = New Article();

			$author = 'none';

			// get comment
			$comment = $comment->single_comment( $commentID );

			if( $comment->adminID != 0 ){
				$user = new User();

				$author = $user->single_user_names( $comment->adminID );

			} else {

				$student = New Student();

				$author = $student->single_student_names( $comment->stdID );
			}

			return $author;
		}

	}

	$smart = new Smart();

?>