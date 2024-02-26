function addPosts(times) {
    const container = document.querySelector('.flex.flex-col.w-full.h-full.text-gray-900.text-xl.border-4.border-gray-900.border-dashed');
    for (let i =  0; i < times; i++) {
      container.appendChild(createPostElement());
    }
}

function createPostElement() {
    const post = document.createElement('div');
    post.classList.add('flex', 'w-full', 'max-w-xl', 'h-60', 'items-center', 'justify-center', 'mx-auto', 'bg-green-400', 'border-b', 'border-gray-600');
    post.textContent = 'Post';
    return post;
}
  
addPosts(2);