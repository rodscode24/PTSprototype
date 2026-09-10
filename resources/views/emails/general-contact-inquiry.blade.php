<h1>General Contact Inquiry {{ $inquiry->identifier }}</h1>

<p><strong>Name:</strong> {{ $inquiry->full_name }}</p>
<p><strong>Email:</strong> {{ $inquiry->email }}</p>
<p><strong>Phone:</strong> {{ $inquiry->phone ?: 'Not provided' }}</p>
<p><strong>Subject:</strong> {{ $inquiry->subject }}</p>

<h2>Message</h2>
<p>{{ $inquiry->message }}</p>
