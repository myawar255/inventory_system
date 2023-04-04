-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 01:41 AM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'F. Scott Fitzgerald', '0', '2023-03-26 15:04:04', '2023-03-26 15:04:04'),
(2, 'Oscar Wilde', '0', '2023-03-26 15:07:23', '2023-03-26 15:07:23'),
(3, 'Kenneth Branagh', '0', '2023-03-26 15:09:44', '2023-03-26 15:09:44'),
(4, 'John Borneman', '0', '2023-03-26 15:14:20', '2023-03-26 15:14:20'),
(5, 'H. G. Wells', '0', '2023-03-26 15:16:10', '2023-03-26 15:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `category_id` int NOT NULL,
  `author_id` int NOT NULL,
  `isbn_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `remaining` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `desc`, `category_id`, `author_id`, `isbn_number`, `published_date`, `price`, `qty`, `remaining`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 'The Great Gatsby: The Only Authorized Edition', 'A deluxe trade paperback edition of The Great Gatsby, a true classic of 20th-century literature and one of America’s best-loved and iconic novels.  This edition of The Great Gatsby has been updated by F. Scott Fitzgerald scholar James L.W. West III to include the author’s final revisions and features a note on the composition and text, a personal foreword by Fitzgerald’s granddaughter, Eleanor Lanahan—and an introduction by two-time National Book Award winner Jesmyn Ward. Featuring the iconic original cover art and French flaps, this is a must-have for all Gatsby fans.  The Great Gatsby, Fitzgerald’s third book, stands as the supreme achievement of his career. First published in 1925, this quintessential novel of the Jazz Age has been acclaimed by generations of readers. The story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan, of lavish parties on Long Island at a time when The New York Times noted “gin was the national drink and sex the national obsession,” it is an exquisitely crafted tale of America in the 1920s.', 1, 1, 'tgg768', '2020-11-17', '12', '10', '10', 'the-great-gatsby-the-only-authorized-edition_iQscj.jpg', '2023-03-26 15:06:40', '2023-03-26 15:06:40'),
(2, 'The Oscar Wilde Collection: 5-Book Paperback Boxed Set', 'This delightful 5-volume box set brings together the classic works of Oscar Wilde, presented with striking contemporary cover designs.  Brilliant writer, flamboyant playwright, and prominent journalist, Oscar Wilde was one of Victorian Britain\'s most accomplished - and notorious - literary figures. Satirical, charming, eminently quotable, yet also acutely observant, Oscar Wilde\'s writing continues to captivate readers to this day.  This brilliant box set contains all of Wilde\'s most famous works, including: • The Picture of Dorian Gray; • The Importance of Being Earnest and Other Plays; • The Ballad of Reading Gaol and Other Poems; • De Profundis • The Happy Prince and Other Stories.  This stylish box set makes a wonderful gift or collectible for any classic literature lover.  ABOUT THE SERIES: The Arcturus Classic Collections series features delightful, high-quality paperback box sets of classic works of literature with striking contemporary cover designs.', 1, 2, 'towc5', '2022-10-30', '39', '8', '8', 'the-oscar-wilde-collection-5-book-paperback-boxed-set_7l2W5.jpg', '2023-03-26 15:09:08', '2023-03-26 15:09:08'),
(3, 'The Chronicles of Narnia Complete Audio Collection', 'For over 60 years, readers of all ages have been enchanted by the magical realms, the epic battles between good and evil, and the unforgettable creatures of Narnia.  This box set includes all seven titles in The Chronicles of Narnia - The Magician\'s Nephew; The Lion, the Witch, and the Wardrobe; The Horse and His Boy; Prince Caspian; The Voyage of the Dawn Treader; The Silver Chair; and The Last Battle.  ©2005 C. S. Lewis (P)2019 HarperCollins Publishers', 1, 3, 'tconcac24', '2019-12-17', '39', '15', '15', 'the-chronicles-of-narnia-complete-audio-collection_sCuVz.jpg', '2023-03-26 15:11:20', '2023-03-26 15:11:20'),
(4, 'The Alchemist, 25th Anniversary: A Fable About Following Your Dream', 'A special 25th anniversary edition of the extraordinary international bestseller, including a new Foreword by Paulo Coelho.  Combining magic, mysticism, wisdom and wonder into an inspiring tale of self-discovery, The Alchemist has become a modern classic, selling millions of copies around the world and transforming the lives of countless readers across generations.  Paulo Coelho\'s masterpiece tells the mystical story of Santiago, an Andalusian shepherd boy who yearns to travel in search of a worldly treasure. His quest will lead him to riches far different—and far more satisfying—than he ever imagined. Santiago\'s journey teaches us about the essential wisdom of listening to our hearts, of recognizing opportunity and learning to read the omens strewn along life\'s path, and, most importantly, to follow our dreams.', 1, 1, 'ta25aaaf', '2014-04-15', '16', '13', '13', 'the-alchemist-25th-anniversary-a-fable-about-following-your-dream_rIF7g.jpg', '2023-03-26 15:13:25', '2023-03-26 15:13:25'),
(5, 'The Brass Man and Other Stories: Tales of Science Fiction, Fantasy, and Mystery', '\"The Brass Man and Other Stories\" is a collection of tales which include science fiction , classic fantasy, contemporary fantasy and a cozy mystery with a fantastical twist.  - The Brass Man - \"A Brass Man sat on the shore polishing himself to perfection.\" Thus begins the titular novella of an innocent people living on a small island surrounded by a world destroying itself through global war and religious fanaticism -- and the brass men created to help protect them. The story is about creation versus destruction and how choices in science and technology impact all of us.  - Elwin\'s House- This is a very short classic fantasy tale of a human and non-human sharing a pipe over a war they fought as opposing soldiers. This story won an honorable mention in the 2005 Year\'s Best Fantasy and Horror.  - The Long Dark Hallway of Desire- Science Fiction Noir. We are given the final paragraphs of an implied larger story of a detective on Mars and his femme fatale. This story was the Editor\'s pick in Flashquake magazine.  - The Man Who Lived Forever - Two friends decide they want to live forever and spend their entire lives exploring how to accomplish this, from the rain forests of Brazil to Mars. But in the end, is living forever really the point?  - Dr. Susan Lee Research Notes - A humorous compendium of small dissertations of failed inventions found in Dr. Lee\'s papers discovered after her death in 2307 CE.  - That Tears Shall Drown the Wind- Aliens versus Humans. Enough said.  - My Yesterdays, Your Tomorrows - Science fiction has brought us many stories of time loops and causality. But this loop contains two lovers trapped inside one week with death on both ends. Note that this story may be considered \"PG\" by some parents.  - Backhoe Vultures - Contemporary fantasy about age, deterioration, and destruction. Does one really ever lose one\'s past?  - Eggs Benedict - Cozy mystery with a serendipitous twist. A modern “detective” who is the figurative descendant of the Three Princes of Serendib.', 3, 4, 'tbmos34t', '2020-06-04', '45', '5', '5', 'the-brass-man-and-other-stories-tales-of-science-fiction-fantasy-and-mystery_2PKUY.jpg', '2023-03-26 15:15:48', '2023-03-26 15:15:48'),
(6, 'H. G. Wells Science Fiction Collection: The Time Machine, The Island of Doctor Moreau, The Invisible Man, The War of the Worlds, The First Men In The Moon', 'Five Books In One! In one, beautifully laid-out volume, five of H. G. Wells\'s most important and beloved science fiction novels -- novels that changed the course of science fiction and fantasy literature and have delighted the imaginations of generations. Included in this volume:  The TIme Machine The Island of Doctor Moreau The Invisible Man The War of the Worlds The First Men In The Moon H.G. Wells (1866-1946) is one of the most influential writers of the 20th century. He is best known for his science fiction works such as The War of the Worlds and The Time Machine, which have made an indelible mark on popular culture. His works were seminal in the development of modern science fiction, and his ideas and themes are still relevant today.  Wells was born in Bromley, England, in 1866. He began his writing career in 1895 with the publication of his first novel, The Time Machine. This novel showcased Wells’s genius for predicting future trends in science and technology. It also introduced the concept of time travel and featured a dystopian future that has since been widely adapted into films and television shows.  Wells wrote numerous other works in the science fiction genre, including The Island of Doctor Moreau, The Invisible Man, and The War of the Worlds. His stories explored themes of social justice, technological progress, and the potential of human evolution. Wells was also an outspoken political activist, speaking out against imperialism, racism, and eugenics.  Wells was a prolific writer and his works have been translated into multiple languages and adapted into numerous films and television shows. His influence on the genre of science fiction is undeniable and his ideas and themes remain relevant to this day. Wells was a visionary and his works will continue to inspire generations to come.', 3, 5, 'hgwsfc34', '2020-03-17', '34', '11', '11', 'h-g-wells-science-fiction-collection-the-time-machine-the-island-of-doctor-moreau-the-invisible-man-the-war-of-the-worlds-the-first-men-in-the-moon_xUX4N.jpg', '2023-03-26 15:17:33', '2023-03-26 15:17:33'),
(7, 'The Big Book of Science Fiction Kindle Edition', 'Quite possibly the GREATEST science-fiction collection of ALL TIME—past, present, and FUTURE! • \"Nearly 1,200 pages of stories by the genre’s luminaries, like H. G. Wells, Arthur C. Clarke and Ursula K. Le Guin, as well as lesser-known authors.\" —The New York Times Book Review  What if life was never-ending? What if you could change your body to adapt to an alien ecology? What if the Pope was a robot? Spanning galaxies and millennia, this must-have anthology showcases classic contributions from H.G. Wells, Arthur C. Clarke, Octavia Butler, and Kurt Vonnegut alongside a century of the eccentrics, rebels, and visionaries who have inspired generations of readers. Within its pages, find beloved worlds of space opera, hard SF, cyberpunk, the new wave, and more. Learn the secret history of science fiction, from literary icons who wrote SF to authors from over 25 countries, some never before translated into English. In THE BIG BOOK OF SCIENCE FICTION, literary power couple Ann and Jeff VanderMeer transport readers from Mars to Mechanopolis, planet Earth to parts unknown. Read the genre that predicted electric cars, travel to the moon, and the modern smart phone. We’ve got the worlds if you’ve got the time.   Including: · Legendary tales from Isaac Asimov and Ursula LeGuin! · An unearthed sci-fi story from W.E.B. DuBois! · The first publication of the work of cybernetic visionary David R. Bunch in 20 years! · A rare and brilliant novella by Chinese international sensation Liu Cixin!  Plus: · Aliens! · Space battles! · Robots! · Technology gone wrong! · Technology gone right!', 3, 5, 'tbbosfke21', '2021-02-02', '34', '12', '12', 'the-big-book-of-science-fiction-kindle-edition_xfBj9.jpg', '2023-03-26 15:22:32', '2023-03-26 15:22:32'),
(8, 'how to draw P0KE: learn to draw all characters step by step in new edition', '💎🔥 Want to become a Pokémon drawing expert? 💎🔥  You\'ve found the right book!  This Deluxe How to Draw includes simple, step-by-step instructions on how to draw classic characters from every Pokémon region -- from Bulbasaur, Charmander, and Squirtle and more .. all the way through Rowlet, Litten, and Popplio... and, of course, Pikachu.…  book details:  ✅ Paperback: 106 pages  ✅ Language: English  ✅ Beautiful artwork and designs  ✅ Suitable for all skill levels  ✅ High-Resolution printing  ✅ Perfectly sized 8.5 x 11 Inches; 21.59 x 27.94 cm  ✅ Cover Type : Glossy / Bleed  ★4 different types of activities for each character★  ① TRACING CHARACTERS✓✓  ② GRID DRAWING WORKSHEET✓✓  ③ COLORING PAGES✓✓  ④ STEP BY STEP DRAWING ALL CHARACTERS✓✓  Makes a perfect Thanksgiving, Christmas, or New Year gift 💖 So, What are you waiting for? Scroll to the top of the page and click the 🥰 ADD TO CART 🥰 button now !  Important : Please note that this is an unofficial Poke coloring book', 10, 1, '979-8386808181', '2018-01-02', '23', '10', '10', 'how-to-draw-p0ke-learn-to-draw-all-characters-step-by-step-in-new-edition_YplEv.jpg', '2023-03-26 15:24:22', '2023-03-26 15:24:22'),
(9, 'The Amazing Spider-Man (Penguin Classics Marvel Collection)', 'The Penguin Classics Marvel Collection presents the origin stories, seminal tales, and characters of the Marvel Universe to explore Marvel’s transformative and timeless influence on an entire genre of fantasy.   A Penguin Classics Marvel Collection Edition   Collects “Spider-Man!” from Amazing Fantasy #15 (1962); The Amazing Spider-Man #1-4, #9, #10, #13, #14, #17-19 (1963-1964); “Goodbye to Linda Brown” from Strange Tales #97 (1962); “How Stan Lee and Steve Ditko Create Spider-Man!” from The Amazing Spider-Man Annual #1 (1964). It is impossible to imagine American popular culture without Marvel Comics. For decades, Marvel has published groundbreaking visual narratives that sustain attention on multiple levels: as metaphors for the experience of difference and otherness; as meditations on the fluid nature of identity; and as high-water marks in the artistic tradition of American cartooning, to name a few.   This anthology contains twelve key stories from the first two years of Spider-Man’s publication history (from 1962 to 1964). These influential adventures not only transformed the super hero fantasy into an allegory for the pain of adolescence but also brought a new ethical complexity to the genre—by insisting that with great power there must also come great responsibility.   A foreword by Jason Reynolds and scholarly introductions and apparatus by Ben Saunders offer further insight into the enduring significance of The Amazing Spider-Man and classic Marvel comics.   The Deluxe Hardcover edition features gold foil stamping, gold top stain edges, special endpapers with artwork spotlighting series villains, and full-color art throughout.', 10, 2, '978-0143135722', '2019-01-17', '23', '6', '6', 'the-amazing-spider-man-penguin-classics-marvel-collection_1evKR.jpg', '2023-03-26 15:25:54', '2023-03-26 15:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Classics', 'classics_lPvV3.jpg', '0', '#7b9b99', '2023-03-26 14:53:59', '2023-03-26 14:53:59'),
(2, 'Tragedy', 'tragedy_p13hm.jpg', '0', '#a11fdc', '2023-03-26 14:54:26', '2023-03-26 14:54:26'),
(3, 'Sci-Fi', 'sci-fi_MqoOE.png', '0', '#ff1359', '2023-03-26 14:55:13', '2023-03-26 14:55:13'),
(4, 'Fantasy', 'fantasy_btJeN.jpg', '0', '#43ddea', '2023-03-26 14:55:35', '2023-03-26 14:55:35'),
(5, 'Action and Adventure', 'action-and-adventure_3dpTt.jpg', '0', '#2c62b7', '2023-03-26 14:56:04', '2023-03-26 14:56:04'),
(6, 'Crime & Mystery', 'crime-mystery_FlaBu.jpg', '0', '#f5923a', '2023-03-26 14:56:48', '2023-03-26 14:56:48'),
(7, 'Romance', 'romance_WusWD.jpg', '0', '#ff70ae', '2023-03-26 14:58:50', '2023-03-26 14:58:50'),
(8, 'Humor and Satire', 'humor-and-satire_0EqHh.jpg', '0', '#d902d2', '2023-03-26 14:59:33', '2023-03-26 14:59:33'),
(9, 'Horror', 'horror_PmX7O.jpg', '0', '#47444b', '2023-03-26 15:00:09', '2023-03-26 15:00:09'),
(10, 'Comics', 'comics_OllyX.jpg', '0', '#e3c817', '2023-03-26 15:00:33', '2023-03-26 15:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `issued_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_03_16_012939_create_authors_table', 1),
(5, '2023_03_16_013110_create_books_table', 1),
(6, '2023_03_16_013355_create_categories_table', 1),
(7, '2023_03_16_013515_create_issued_books_table', 1),
(8, '2023_03_16_015733_create_permission_tables', 1),
(9, '2023_03_25_154604_create_requested_books_table', 1),
(10, '2023_03_25_154814_create_reserved_requests_table', 1),
(11, '2023_03_25_155016_create_renew_requests_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renew_requests`
--

CREATE TABLE `renew_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `issued_book_id` int NOT NULL,
  `return_date` date NOT NULL,
  `approved` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requested_books`
--

CREATE TABLE `requested_books` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `book_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_requests`
--

CREATE TABLE `reserved_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `approved` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-03-26 14:47:37', '2023-03-26 14:47:37'),
(2, 'student', 'web', '2023-03-26 14:47:37', '2023-03-26 14:47:37'),
(3, 'librarian', 'web', '2023-03-26 14:47:37', '2023-03-26 14:47:37'),
(4, 'faculty', 'web', '2023-03-26 14:47:37', '2023-03-26 14:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `personal_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `personal_id`, `name`, `email`, `mobile`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AbO7CGB0G1', 'Admin User', 'admin@gmail.com', '1234567890', '1', '2023-03-26 14:47:37', '$2y$10$szsYqgA0XC.suM34n4Mi4uj1fqt8XvK0VaXaqGVmG/TFSIRks/mBa', 'YJR5QmEMQcNZOVkpcnWBplDjrfS4TRUg5QM04ziFvb8zXRtclYqAPwvVwn4U', '2023-03-26 14:47:37', '2023-03-26 14:47:37'),
(2, 'T9A25nfKrd', 'John', 'student@gmail.com', '0987654321', '0', NULL, '$2y$10$XpDpnnX/0jT1zROyawme3u85.tT/NcFXtvTMmWByp3ZzWVYf90fEq', 'VKwmM181gb7mFVziySCbacueWTiJNsRlr2IyS5BPLp3uQSHCNppLfc9ihptL', '2023-03-26 14:47:37', '2023-03-26 14:47:37'),
(3, NULL, 'Alex', 'librarian@gmail.com', NULL, '0', NULL, '$2y$10$VIs.jT.BhuRwJxcbMGM/luJ8Q78AeHFltrr.vB/CNzQmrMpJVtBdW', NULL, '2023-03-26 14:52:55', '2023-03-26 14:52:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `renew_requests`
--
ALTER TABLE `renew_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_books`
--
ALTER TABLE `requested_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_requests`
--
ALTER TABLE `reserved_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renew_requests`
--
ALTER TABLE `renew_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requested_books`
--
ALTER TABLE `requested_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserved_requests`
--
ALTER TABLE `reserved_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
