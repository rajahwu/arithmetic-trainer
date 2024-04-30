# Database Structure

## Tables

```text
Users Table
id: UUID (Primary Key)
username: Text
email: Text
password: Text (hashed)
Other user-related fields as needed
```

```text
Profiles Table
id: UUID (Primary Key)
user_id: UUID (Foreign Key referencing Users)
Other profile-related fields (e.g., profile picture, bio, etc.)
```

```text
ProblemSet Table
id: UUID (Primary Key)
text: Text (Question text)
solution: Text (Solution text)
category: Text (Category of the problem)
```

```text
Practice Sessions Table
id: UUID (Primary Key)
user_id: UUID (Foreign Key referencing Users)
problem_id: UUID (Foreign Key referencing Problems)
timestamp: Timestamp (When the practice session occurred)
```

```text
Quizzes/Exams Table
id: UUID (Primary Key)
title: Text (Title of the quiz/exam)
description: Text (Description of the quiz/exam)
timestamp: Timestamp (When the quiz/exam was created)
```

```text
Quiz/Exam Questions Table
id: UUID (Primary Key)
quiz_id: UUID (Foreign Key referencing Quizzes/Exams)
problem_id: UUID (Foreign Key referencing Problems)
```

```text
User Quiz/Exam Attempts Table
id: UUID (Primary Key)
user_id: UUID (Foreign Key referencing Users)
quiz_id: UUID (Foreign Key referencing Quizzes/Exams)
timestamp: Timestamp (When the attempt was made)
score: Integer (Score achieved in the attempt)
```

```text
Assessments Table
id: UUID (Primary Key)
title: Text (Title of the assessment)
description: Text (Description of the assessment)
timestamp: Timestamp (When the assessment was created)
```

```text
Assessment Questions Table
id: UUID (Primary Key)
assessment_id: UUID (Foreign Key referencing Assessments)
problem_id: UUID (Foreign Key referencing Problems)
```

```text
User Assessment Attempts Table
id: UUID (Primary Key)
user_id: UUID (Foreign Key referencing Users)
assessment_id: UUID (Foreign Key referencing Assessments)
timestamp: Timestamp (When the attempt was made)
score: Integer (Score achieved in the attempt)
```