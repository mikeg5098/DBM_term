CREATE TABLE IF NOT EXISTS `php_interview_questions` (
`id` int(8) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `row_order` int(8) NOT NULL
)

INSERT INTO `php_interview_questions` (`id`, `question`, `answer`, `row_order`) VALUES
(1, 'PHP array functions example', 'is_array(), in_array(), array_keys(),array_values()', 3),
(2, 'How to redirect using PHP', 'Using header() function', 4),
(3, 'Differentiate PHP size() and count():', 'Same. But count() is preferable.', 1),
(4, 'What is PHP?', 'A server side scripting language.', 0),
(5, 'What is php.ini?', 'PHP configuration file.', 2);